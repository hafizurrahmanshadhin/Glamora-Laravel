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
            $minRating        = 6 - $rating; // Convert dropdown value to corresponding rating
            $approvedServices = $approvedServices->filter(function ($service) use ($minRating) {
                return $service->average_rating >= $minRating;
            });
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

        return view('frontend.layouts.available_services.index', [
            'serviceId'        => $serviceId,
            'approvedServices' => $approvedServices,
            'selectedRating'   => $rating,
            'selectedPrice'    => $priceRange,
        ]);
    }
}
