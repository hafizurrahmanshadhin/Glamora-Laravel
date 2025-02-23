<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\View\View;

class AvailableServicesController extends Controller {
    /**
     * Display the available beauty services page.
     *
     * @param mixed $serviceId Optional serviceId from the route.
     * @return View
     */
    public function index($serviceId = null): View {
        $rating     = request('rating');
        $priceRange = request('price_range');
        $location   = request('location');

        // Retrieve serviceIds from query parameters.
        $queryParamIds = request('service_ids');
        if ($queryParamIds && !is_array($queryParamIds)) {
            $queryParamIds = explode(',', $queryParamIds);
        }

        // If no query parameter provided but route parameter exists, use that
        if (empty($queryParamIds) && $serviceId) {
            $queryParamIds = [$serviceId];
        }

        // Fetch selected service names (if any)
        $selectedServiceNames = [];
        if (!empty($queryParamIds)) {
            $selectedServiceNames = Service::whereIn('id', $queryParamIds)
                ->pluck('services_name')
                ->toArray();
        }

        // Build the query for approved services.
        $query = UserService::where('status', 'active')->with(['service', 'user']);
        if (!empty($queryParamIds)) {
            $query->whereIn('service_id', $queryParamIds);
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

        // Filter by rating if selected
        if ($rating) {
            $ratingMap = [
                1 => [5.0, 5.9],
                2 => [4.0, 4.9],
                3 => [3.0, 3.9],
                4 => [2.0, 2.9],
                5 => [1.0, 1.9],
                6 => [0.0, 0.9],
            ];
            if (isset($ratingMap[$rating])) {
                [$minRating, $maxRating] = $ratingMap[$rating];
                $approvedServices        = $approvedServices->filter(function ($service) use ($minRating, $maxRating) {
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
                    return stripos($businessInfo->business_address, $location) !== false ||
                    stripos($businessInfo->address, $location) !== false;
                }
                return false;
            });
        }

        return view('frontend.layouts.available_services.index', [
            'serviceId'            => $serviceId,
            'serviceIds'           => $queryParamIds,
            'selectedServiceNames' => $selectedServiceNames,
            'approvedServices'     => $approvedServices,
            'selectedRating'       => $rating,
            'selectedPrice'        => $priceRange,
            'location'             => $location,
        ]);
    }
}
