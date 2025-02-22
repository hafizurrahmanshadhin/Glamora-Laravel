<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use App\Models\TravelRadius;
use App\Models\User;
use App\Models\UserGallery;
use App\Models\UserService;
use App\Models\UserTool;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceProviderProfileController extends Controller {
    /**
     * Display the service provider profile page.
     *
     * @return View
     */
    public function index(Request $request, $userId, $serviceId): View {
        $user = User::with(['userServices.service'])->findOrFail($userId);

        // Calculate this user’s average rating
        $avg = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->avg('rating') ?? 0;
        $averageRating = round($avg * 2) / 2;

        // Count total reviews for this user
        $reviewCount = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->count();

        $reviews = Review::whereHas('booking.userService', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['booking.userService'])->get();

        return view('frontend.layouts.service_provider_profile.index', [
            'user'          => $user,
            'serviceId'     => $serviceId,
            'reviews'       => $reviews,
            'averageRating' => $averageRating,
            'reviewCount'   => $reviewCount,
            'serviceIds'    => $request->query('service_ids'), // Pass the service_ids to the view
        ]);
    }

    /**
     * Display the service provider profile edit page.
     *
     * @return View
     */
    public function editProfile(): View {
        $user   = Auth::user()->load('userServices.service');
        $userId = Auth::id();

        // Calculate this user’s average rating
        $avg = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->avg('rating') ?? 0;
        $averageRating = round($avg * 2) / 2;

        // Count total reviews for this user
        $reviewCount = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->count();

        $reviews = Review::whereHas('booking.userService', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['booking.userService'])->get();

        return view('frontend.layouts.beauty_expert_dashboard.profile', [
            'user'          => $user,
            'averageRating' => $averageRating,
            'reviewCount'   => $reviewCount,
            'reviews'       => $reviews,
        ]);
    }

    /**
     * Store a newly created tool in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $request->validate(['tool_name' => 'required|string']);

        $tool = UserTool::create([
            'user_id'   => Auth::id(),
            'tool_name' => $request->tool_name,
        ]);

        return Helper::jsonResponse(true, 'Tool added successfully.', 201, $tool);
    }

    /**
     * Remove the specified tool from storage.
     *
     * @param UserTool $tool
     * @return JsonResponse
     */
    public function destroy(UserTool $tool): JsonResponse {
        if ($tool->user_id !== Auth::id()) {
            return Helper::jsonResponse(false, 'Unauthorized', 403);
        }

        $tool->delete();

        return Helper::jsonResponse(true, 'Tool deleted successfully.', 200);
    }

    /**
     * Store a newly created gallery image in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeGallery(Request $request): JsonResponse {
        $request->validate([
            'image' => 'required|image|max:10240',
        ]);

        $user         = auth()->user();
        $file         = $request->file('image');
        $uploadedPath = Helper::fileUpload($file, 'galleries', $user->name ?: 'gallery');

        if (!$uploadedPath) {
            return Helper::jsonResponse(false, 'File upload failed.', 500);
        }

        $gallery = UserGallery::create([
            'user_id' => $user->id,
            'image'   => $uploadedPath,
        ]);

        return Helper::jsonResponse(true, 'Gallery image added successfully.', 201, $gallery);
    }

    /**
     * Remove the specified gallery image from storage.
     *
     * @param UserGallery $gallery
     * @return JsonResponse
     */
    public function destroyGallery(UserGallery $gallery): JsonResponse {
        if ($gallery->user_id !== auth()->id()) {
            return Helper::jsonResponse(false, 'Unauthorized', 403);
        }

        Helper::fileDelete(public_path($gallery->image));

        $gallery->delete();

        return Helper::jsonResponse(true, 'Gallery image deleted successfully.', 200);
    }

    /**
     * Display the service provider edit service information page.
     *
     * @param int $userId
     * @return View
     */
    public function editServiceInformation(int $userId): View {
        $user             = User::findOrFail($userId);
        $businessInfo     = $user->businessInformation;
        $services         = Service::all();
        $selectedServices = $user->userServices->pluck('service_id')->toArray();
        $travelRadius     = TravelRadius::where('user_id', $userId)->first();

        // Build an array of service data in which each element holds the service plus the user's saved info.
        $servicesData = $services->map(function ($service) use ($user) {
            $userService = $user->userServices->where('service_id', $service->id)->first();
            return [
                'service'       => $service,
                'selected'      => $userService ? $userService->selected : false,
                'offered_price' => $userService ? $userService->offered_price : '',
                'total_price'   => $userService ? $userService->total_price : '',
                'image'         => $userService ? $userService->image : '',
            ];
        });

        return view('frontend.layouts.beauty_expert_dashboard.edit-service-information',
            compact('businessInfo', 'user', 'servicesData', 'selectedServices', 'travelRadius')
        );
    }

    /**
     * Update the service information for the specified user.
     *
     * @param Request $request
     * @param int $userId
     * @return RedirectResponse
     */
    public function updateServiceInformation(Request $request, int $userId): RedirectResponse {
        try {
            $user = User::findOrFail($userId);

            // Validate business & document fields.
            $businessRules = [
                'name'               => 'required|string|max:255',
                'bio'                => 'required|string',
                'business_name'      => 'required|string|max:255',
                'business_address'   => 'required|string',
                'professional_title' => 'required|string|max:255',
            ];
            // Optionally validate file if new ones uploaded.
            if ($request->hasFile('avatar')) {
                $businessRules['avatar'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:20480';
            }
            if ($request->hasFile('license')) {
                $businessRules['license'] = 'file|mimes:pdf,jpg,png|max:20480';
            }
            $validatedBusiness = $request->validate($businessRules);

            // Update Business Information:
            $businessData = [
                'name'               => $validatedBusiness['name'],
                'bio'                => $validatedBusiness['bio'],
                'business_name'      => $validatedBusiness['business_name'],
                'business_address'   => $validatedBusiness['business_address'],
                'professional_title' => $validatedBusiness['professional_title'],
            ];
            if ($request->hasFile('avatar')) {
                $businessData['avatar'] = Helper::fileUpload($request->file('avatar'), 'avatars', $validatedBusiness['name']);
            }
            if ($request->hasFile('license')) {
                $businessData['license'] = Helper::fileUpload($request->file('license'), 'licenses', $validatedBusiness['name']);
            }
            $user->businessInformation->update($businessData);

            // Validate and update travel radius info.
            $radiusData = $request->validate([
                'free_radius'       => 'required|integer|min:0',
                'travel_radius'     => 'required|integer|min:0',
                'travel_charge'     => 'required|numeric|min:0',
                'max_radius'        => 'required|integer|min:0',
                'max_charge'        => 'required|numeric|min:0',
                'min_booking_value' => 'nullable|numeric|min:0',
            ]);
            TravelRadius::updateOrCreate(
                ['user_id' => $userId],
                $radiusData
            );

            if ($request->has('services')) {
                $services = $request->input('services');
                foreach ($services as $index => $data) {
                    // Look for an existing record including soft-deleted ones.
                    $existingService = UserService::withTrashed()->where([
                        'user_id'    => $userId,
                        'service_id' => $data['service_id'],
                    ])->first();

                    if (empty($data['selected']) || !$data['selected']) {
                        // If unselected and the record exists, soft-delete it.
                        if ($existingService) {
                            $existingService->delete();
                        }
                    } else {
                        $serviceData = [
                            'selected'      => $data['selected'],
                            'offered_price' => $data['offered_price'] ?? 0,
                            'total_price'   => $data['total_price'] ?? 0,
                        ];
                        if ($request->hasFile("services.$index.image")) {
                            $serviceData['image'] = Helper::fileUpload(
                                $request->file("services.$index.image"),
                                'user_services_images',
                                'service_' . $data['service_id']
                            );
                        }
                        if ($existingService) {
                            // If the record was soft-deleted, restore it.
                            if ($existingService->trashed()) {
                                $existingService->restore();
                            }
                            $existingService->update($serviceData);
                        } else {
                            // Create new record if none exists.
                            $serviceData['user_id']    = $userId;
                            $serviceData['service_id'] = $data['service_id'];
                            UserService::create($serviceData);
                        }
                    }
                }
            }

            return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Service information updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'An error occurred while updating service information.');
        }
    }

    /**
     * Update the service provider's location.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateLocation(Request $request) {
        $data = $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'address'   => 'required|string',
        ]);

        $info = auth()->user()->businessInformation;

        if ($info) {
            $info->update([
                'latitude'  => $data['latitude'],
                'longitude' => $data['longitude'],
                'address'   => $data['address'],
            ]);
        } else {
            auth()->user()->businessInformation()->create($data);
        }

        return response()->json(['status' => 'success']);
    }
}
