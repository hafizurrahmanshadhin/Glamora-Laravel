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
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the home page with various data.
     *
     * @return View|JsonResponse
     * @throws Exception
     * @description This method retrieves various data for the home page, including system settings,
     * approved services, active services, review statistics, latest reviews, top beauty experts,
     * home banners, testimonial images, join us section, and service types.
     *
     * It uses caching to optimize performance and reduce database queries.
     * If an error occurs, it returns a JSON response with an error message.
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

            $approvedServices = Cache::remember('approved_services', 300, function () {
                return UserService::where('status', 'active')
                    ->with('service')
                    ->selectRaw('user_services.*, (
                          SELECT COUNT(DISTINCT us.user_id)
                          FROM user_services as us
                          WHERE us.service_id = user_services.service_id AND us.status = "active"
                      ) as styler_count')
                    ->get();
            });

            $reviewStats = Cache::remember('review_stats', 300, function () {
                return Review::where('status', 'active')
                    ->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_reviews')
                    ->first();
            });
            $averageRating = $reviewStats->average_rating ?? 0;
            $totalReviews  = $reviewStats->total_reviews;

            $reviews = Cache::remember('latest_reviews', 300, function () {
                return Review::with('user')->where('status', 'active')->latest()->take(5)->get();
            });

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
