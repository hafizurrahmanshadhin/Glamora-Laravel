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
        $rating     = request('rating');
        $priceRange = request('price_range');
        $location   = request('location');

        $query = UserService::where('status', 'active')->with(['service', 'user']);

        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }

        $approvedServices = $query->get()->map(function ($service) {
            $averageRating = Review::where('status', 'active')
                ->whereHas('booking.userService', function ($q) use ($service) {
                    $q->where('user_id', $service->user_id);
                })
                ->avg('rating') ?? 0;

            $service->average_rating = round($averageRating * 2) / 2;
            $service->review_count   = Review::where('status', 'active')
                ->whereHas('booking.userService', function ($q) use ($service) {
                    $q->where('user_id', $service->user_id);
                })
                ->count();
            $service->styler_count = UserService::where('service_id', $service->service_id)
                ->where('status', 'active')
                ->distinct('user_id')
                ->count();

            return $service;
        });

        // Filter by rating if selected (greater than or equal to the selected rating)
        if ($rating) {
            $ratingMap = [
                1 => [5.0, 5.9], // If selected "5 Star", show ratings 5.0 - 5.9
                2 => [4.0, 4.9], // If selected "4 Star", show ratings 4.0 - 4.9
                3 => [3.0, 3.9], // If selected "3 Star", show ratings 3.0 - 3.9
                4 => [2.0, 2.9], // If selected "2 Star", show ratings 2.0 - 2.9
                5 => [1.0, 1.9], // If selected "1 Star", show ratings 1.0 - 1.9
                6 => [0.0, 0.9], // If selected "0 Star", show ratings 0.0 - 0.9
            ];

            if (isset($ratingMap[$rating])) {
                [$minRating, $maxRating] = $ratingMap[$rating];

                $approvedServices = $approvedServices->filter(function ($service) use ($minRating, $maxRating) {
                    return $service->average_rating >= $minRating && $service->average_rating <= $maxRating;
                });
            }
        }

        // Filter by price range if selected
        if ($priceRange) {
            $approvedServices = $approvedServices->filter(function ($service) use ($priceRange) {
                $price = (float) $service->total_price;
                switch ($priceRange) {
                case '10-100':
                    return $price >= 10 && $price <= 100;
                case '101-200':
                    return $price >= 101 && $price <= 200;
                case '500-1000':
                    return $price >= 500 && $price <= 1000;
                case '1000+':
                    return $price > 1000;
                default:
                    return true;
                }
            });
        }

        // Filter by location if provided
        if ($location) {
            $approvedServices = $approvedServices->filter(function ($service) use ($location) {
                if ($service->user && $service->user->businessInformation) {
                    $businessInfo = $service->user->businessInformation;
                    // Check if either business_address or address contains the search string
                    return stripos($businessInfo->business_address, $location) !== false ||
                    stripos($businessInfo->address, $location) !== false;
                }
                return false;
            });
        }

        return view('frontend.layouts.available_services.index', [
            'serviceId'        => $serviceId,
            'approvedServices' => $approvedServices,
            'selectedRating'   => $rating,
            'selectedPrice'    => $priceRange,
            'location'         => $location,
        ]);
    }
}
