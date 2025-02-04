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
    public function index(): View {
        $systemSetting = SystemSetting::first();

        $approvedServices = UserService::where('status', 'active')
            ->with('service')
            ->get()
            ->map(function ($userService) {
                $stylerCount = UserService::where('service_id', $userService->service_id)
                    ->where('status', 'active')
                    ->distinct('user_id')
                    ->count();

                $userService->styler_count = $stylerCount;

                return $userService;
            });

        // Fetch active services
        $services = Service::where('status', 'active')->get();

        // Calculate average rating and total reviews
        $averageRating = Review::where('status', 'active')->avg('rating') ?? 0;
        $totalReviews  = Review::where('status', 'active')->count();

        // Fetch all reviews
        $reviews = Review::with('user')
            ->where('status', 'active')
            ->latest()
            ->get();

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
