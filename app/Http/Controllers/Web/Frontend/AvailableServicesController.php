<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\UserService;
use Illuminate\View\View;

class AvailableServicesController extends Controller {
    /**
     * Display the available beauty services page.
     *
     * @return View
     */
    public function index($serviceId): View {
        $query = UserService::where('status', 'active')
            ->with(['service', 'user']);

        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }

        $approvedServices = $query->get()->map(function ($service) {
            // Calculate average rating for this service’s provider (service->user_id)
            $averageRating = Review::where('status', 'active')
                ->whereHas('booking.userService', function ($q) use ($service) {
                    $q->where('user_id', $service->user_id);
                })
                ->avg('rating') ?? 0;

            // Round to the nearest 0.5
            $service->average_rating = round($averageRating * 2) / 2;

            // Count total reviews for this service’s provider
            $service->review_count = (int) Review::where('status', 'active')
                ->whereHas('booking.userService', function ($q) use ($service) {
                    $q->where('user_id', $service->user_id);
                })
                ->count();

            // Example: count total stylers offering this same service_id
            $service->styler_count = UserService::where('service_id', $service->service_id)
                ->where('status', 'active')
                ->distinct('user_id')
                ->count();

            return $service;
        });

        return view('frontend.layouts.available_services.index', [
            'serviceId'        => $serviceId,
            'approvedServices' => $approvedServices,
        ]);
    }
}
