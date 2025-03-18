<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BusinessInformation;
use App\Models\Service;
use App\Models\TravelRadius;
use App\Models\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BusinessInformationController extends Controller {
    /**
     * Display the business-information view.
     */
    public function index(): View | JsonResponse {
        try {
            $services = Service::where('status', 'active')->get();
            return view('auth.layouts.business-information', compact('services'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store the business information.
     */
    public function store(Request $request) {
        DB::beginTransaction();
        try {
            // store step 1 data
            if ($request->hasFile('avatar')) {
                $validated = $request->validate([
                    'avatar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                    'name'               => 'required|string|max:255',
                    'bio'                => 'required|string',
                    'business_name'      => 'required|string|max:255',
                    'business_address'   => 'required|string',
                    'professional_title' => 'required|string|max:255',
                    'license'            => 'required|file|mimes:pdf,jpg,png|max:20480',
                ]);

                $avatarPath  = Helper::fileUpload($request->file('avatar'), 'avatars', $validated['name']);
                $licensePath = Helper::fileUpload($request->file('license'), 'licenses', $validated['name']);

                if (!$avatarPath || !$licensePath) {
                    DB::rollBack();
                    return redirect()->back()->with('t-error', 'Failed to upload files. Please try again.');
                }

                BusinessInformation::create([
                    'user_id'            => Auth::id(),
                    'avatar'             => $avatarPath,
                    'name'               => $validated['name'],
                    'bio'                => $validated['bio'],
                    'business_name'      => $validated['business_name'],
                    'business_address'   => $validated['business_address'],
                    'professional_title' => $validated['professional_title'],
                    'license'            => $licensePath,
                ]);

                DB::commit();
                return response()->json(['status' => 'ok']);
            }

            // store step 2 data
            if ($request->has('free_radius')) {
                $validated = $request->validate([
                    'free_radius'       => 'required|integer|min:0',
                    'travel_radius'     => 'required|integer|min:0',
                    'travel_charge'     => 'required|numeric|min:0',
                    'max_radius'        => 'required|integer|min:0',
                    'max_charge'        => 'required|numeric|min:0',
                    'min_booking_value' => 'nullable|numeric|min:0',
                ]);

                TravelRadius::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'free_radius'       => $validated['free_radius'],
                        'travel_radius'     => $validated['travel_radius'],
                        'travel_charge'     => $validated['travel_charge'],
                        'max_radius'        => $validated['max_radius'],
                        'max_charge'        => $validated['max_charge'],
                        'min_booking_value' => $validated['min_booking_value'],
                    ]
                );

                DB::commit();
                return response()->json(['status' => 'ok']);
            }

            // store step 3 data
            if ($request->has('services')) {
                $validated = $request->validate([
                    'services'                 => 'required|array',
                    'services.*.service_id'    => 'required|exists:services,id',
                    'services.*.selected'      => 'boolean',
                    'services.*.offered_price' => 'numeric',
                    'services.*.total_price'   => 'numeric',
                    'services.*.image'         => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
                ]);

                foreach ($validated['services'] as $index => $data) {
                    $imagePath = null;
                    if (!empty($data['image'])) {
                        $imagePath = Helper::fileUpload($data['image'], 'user_services_images', 'service_image_' . $index);
                    }

                    UserService::updateOrCreate(
                        [
                            'user_id'    => Auth::id(),
                            'service_id' => $data['service_id'],
                        ],
                        [
                            'selected'      => $data['selected'],
                            'offered_price' => $data['offered_price'],
                            'total_price'   => $data['total_price'],
                            'image'         => $imagePath,
                            'status'        => 'active',
                        ]
                    );
                }

                // Log out the user after storing the information
                Auth::guard('web')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                DB::commit();
                return redirect()
                    ->route('profile-submitted')
                    ->with('status', 'Your profile information has been submitted. Please wait for approval.');
            }

            DB::rollBack();
            return Helper::jsonResponse(false, 'No data to process', 400);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store the location of the business.
     */
    public function storeLocation(Request $request): JsonResponse {
        try {
            $request->validate([
                'latitude'  => 'required|numeric',
                'longitude' => 'required|numeric',
                'address'   => 'required|string',
            ]);

            $info = auth()->user()->businessInformation;

            if ($info) {
                $info->update([
                    'latitude'  => $request->latitude,
                    'longitude' => $request->longitude,
                    'address'   => $request->address,
                ]);
            }
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
