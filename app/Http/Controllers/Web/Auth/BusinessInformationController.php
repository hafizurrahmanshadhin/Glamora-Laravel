<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BusinessInformation;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BusinessInformationController extends Controller {
    /**
     * Display the business-information view.
     */
    public function index(): View {
        $services = Service::where('status', 'active')->get();
        return view('auth.layouts.business-information', compact('services'));
    }

    public function store(Request $request) {
        // If "services" present => store step 3 data
        if ($request->has('services')) {
            $validated = $request->validate([
                'services'                 => 'required|array',
                'services.*.service_id'    => 'required|exists:services,id',
                'services.*.selected'      => 'boolean',
                'services.*.offered_price' => 'numeric',
                'services.*.total_price'   => 'numeric',
                'services.*.image'         => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            ]);

            foreach ($validated['services'] as $data) {
                $imagePath = null;
                if (!empty($data['image'])) {
                    $imagePath = Helper::fileUpload($data['image'], 'user_services_images', Auth::id());
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
                    ]
                );
            }

            return response()->json(['status' => 'ok']);
        }

        // Otherwise store step 1 data
        $validated = $request->validate([
            'avatar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'name'               => 'required|string|max:255',
            'bio'                => 'required|string',
            'business_name'      => 'required|string|max:255',
            'professional_title' => 'required|string|max:255',
            'license'            => 'required|file|mimes:pdf,jpg,png|max:10240',
        ]);

        $avatarPath  = Helper::fileUpload($request->file('avatar'), 'avatars', $validated['name']);
        $licensePath = Helper::fileUpload($request->file('license'), 'licenses', $validated['name']);

        if (!$avatarPath || !$licensePath) {
            return redirect()->back()->with('t-error', 'Failed to upload files. Please try again.');
        }

        BusinessInformation::create([
            'user_id'            => Auth::id(),
            'avatar'             => $avatarPath,
            'name'               => $validated['name'],
            'bio'                => $validated['bio'],
            'business_name'      => $validated['business_name'],
            'professional_title' => $validated['professional_title'],
            'license'            => $licensePath,
        ]);

        return redirect()->route('beauty-expert-dashboard')
            ->with('t-success', 'Business information updated successfully.');
    }
}
