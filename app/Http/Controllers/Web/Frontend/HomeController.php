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
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the home page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $systemSetting = SystemSetting::first();

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

            // Fetch dynamic home page banners from the CMS images table
            $homeBanners = CMSImage::where('page', 'home')
                ->where('status', 'active')
                ->get();

            $testimonialImage = CMSImage::where('page', 'testimonial')
                ->where('status', 'active')
                ->latest()
                ->first();

            // Fetch the "Join Us" section from the CMS
            $joinUs = CMS::where('section', 'join_us')->first();

            // Fetch service types for the user type container section
            $serviceTypes = CMS::where('section', 'user-type-container')->where('status', 'active')->orderBy('id')->get();

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
