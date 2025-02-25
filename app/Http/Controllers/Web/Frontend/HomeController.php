<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserService;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the home page.
     *
     * @return View
     */
    // public function index(): View {
    //     $systemSetting = SystemSetting::first();

    //     $approvedServices = UserService::where('status', 'active')
    //         ->with('service')
    //         ->get()
    //         ->map(function ($userService) {
    //             $stylerCount = UserService::where('service_id', $userService->service_id)
    //                 ->where('status', 'active')
    //                 ->distinct('user_id')
    //                 ->count();

    //             $userService->styler_count = $stylerCount;

    //             return $userService;
    //         });

    //     // Fetch active services
    //     $services = Service::where('status', 'active')->get();

    //     // Calculate average rating and total reviews
    //     $averageRating = Review::where('status', 'active')->avg('rating') ?? 0;
    //     $totalReviews  = Review::where('status', 'active')->count();

    //     // Fetch all reviews
    //     $reviews = Review::with('user')
    //         ->where('status', 'active')
    //         ->latest()
    //         ->get();

    //     $topBeautyExperts = User::where('role', 'beauty_expert')
    //         ->where('status', 'active')
    //         ->with('businessInformation')
    //         ->get();

    //     return view('frontend.layouts.home.index', compact(
    //         'systemSetting',
    //         'approvedServices',
    //         'services',
    //         'reviews',
    //         'averageRating',
    //         'totalReviews',
    //         'topBeautyExperts'
    //     ));
    // }

    public function index(): View {
        $systemSetting = SystemSetting::first();

        // Optimized approved services query with a SQL subquery
        $approvedServices = UserService::where('status', 'active')
            ->with('service')
            ->selectRaw('user_services.*, (
                SELECT COUNT(DISTINCT us.user_id)
                FROM user_services as us
                WHERE us.service_id = user_services.service_id AND us.status = "active"
            ) as styler_count')
            ->get();

        // Fetch active services
        $services = Service::where('status', 'active')->get();

        // Combine review stats into one query
        $reviewStats = Review::where('status', 'active')
            ->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_reviews')
            ->first();
        $averageRating = $reviewStats->average_rating ?? 0;
        $totalReviews  = $reviewStats->total_reviews;

        // Fetch all reviews
        $reviews = Review::with('user')
            ->where('status', 'active')
            ->latest()
            ->get();

        // Fetch top beauty experts
        $topBeautyExperts = User::where('role', 'beauty_expert')
            ->where('status', 'active')
            ->with('businessInformation')
            ->get();

        return view('frontend.layouts.home.index', compact(
            'systemSetting',
            'approvedServices',
            'services',
            'reviews',
            'averageRating',
            'totalReviews',
            'topBeautyExperts'
        ));
    }
}
