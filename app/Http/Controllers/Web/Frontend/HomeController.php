<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\CMSImage;
use App\Models\Review;
use App\Models\Service;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the home page with various data.
     *
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(): View | JsonResponse {
        try {
            // Fetching data using static methods from models
            $systemSetting    = SystemSetting::current();
            $services         = Service::activeServices();
            $homeBanners      = CMSImage::homeBanners();
            $testimonialImage = CMSImage::testimonialImage();
            $joinUs           = CMS::joinUs();
            $serviceTypes     = CMS::serviceTypes();

            // Get all approved services with their users and services (cache for 5 minutes)
            $approvedServices = Cache::remember('approved_services_base', 300, function () {
                return UserService::active()->with(['service', 'user'])->get();
            });

            // Get all styler counts in one query (cache for just 1 minute)
            $allCounts = Cache::remember('all_styler_counts', 60, function () {
                return DB::table('user_services as us')
                    ->join('users as u', 'us.user_id', '=', 'u.id')
                    ->where('us.status', 'active')
                    ->where('u.status', 'active')
                    ->where(function ($q) {
                        $q->whereNull('u.banned_until')
                            ->orWhere('u.banned_until', '<=', now());
                    })
                    ->whereNull('us.deleted_at')
                    ->whereNull('u.deleted_at')
                    ->select('us.service_id')
                    ->selectRaw('COUNT(DISTINCT us.user_id) as count')
                    ->groupBy('us.service_id')
                    ->pluck('count', 'service_id')
                    ->toArray();
            });

            // Map the styler counts to the approved services
            $approvedServices = $approvedServices->map(function ($service) use ($allCounts) {
                $service->styler_count = $allCounts[$service->service_id] ?? 0;
                return $service;
            });

            // Retrieve review statistics and latest reviews. Cache for 5 minutes.
            $reviewStats = Cache::remember('review_stats', 300, function () {
                return Review::where('status', 'active')
                    ->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_reviews')
                    ->first();
            });
            $averageRating = $reviewStats->average_rating ?? 0;
            $totalReviews  = $reviewStats->total_reviews;

            // Retrieve latest reviews with user relation, cache for 5 minutes
            $reviews = Cache::remember('latest_reviews', 300, function () {
                return Review::with('user')->where('status', 'active')->latest()->take(5)->get();
            });

            // Get top beauty experts (active users with role 'beauty_expert')
            $topBeautyExperts = Cache::remember('top_beauty_experts', 300, function () {
                return User::where('role', 'beauty_expert')
                    ->where('status', 'active')
                    ->with('businessInformation')
                    ->get();
            });

            return view('frontend.layouts.home.index', compact(
                'systemSetting',
                'approvedServices',
                'services',
                'reviews',
                'averageRating',
                'totalReviews',
                'topBeautyExperts',
                'homeBanners',
                'testimonialImage',
                'joinUs',
                'serviceTypes'
            ));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
