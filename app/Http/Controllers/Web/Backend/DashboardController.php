<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\DynamicPage;
use App\Models\FAQ;
use App\Models\Report;
use App\Models\Review;
use App\Models\Service;
use App\Models\SocialMedia;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller {
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index(): View | JsonResponse {
        try {
            // User Statistics
            $userStats = [
                'total'         => User::count(),
                'clients'       => User::where('role', 'client')->count(),
                'beautyExperts' => User::where('role', 'beauty_expert')->count(),
                'newThisWeek'   => User::where('created_at', '>=', now()->subWeek())->count(),
            ];

            // Booking Statistics
            $bookingStats = [
                'total'       => Booking::count(),
                'newThisWeek' => Booking::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            ];

            // Service Statistics
            $serviceStats = [
                'totalServices'  => Service::count(),
                'activeServices' => Service::where('status', 'active')->count(),
                'popularService' => Service::withCount('userServices')
                    ->orderByDesc('user_services_count')
                    ->first(),
            ];

            // System Statistics
            $systemStats = [
                'faqs'        => FAQ::count(),
                'activePages' => DynamicPage::where('status', 'active')->count(),
                'socialMedia' => SocialMedia::count(),
                'reports'     => Report::where('status', 'active')->count(),
            ];

            // Recent Activities
            $recentActivities = [
                'bookings' => Booking::with(['user', 'userService'])
                    ->latest()
                    ->take(5)
                    ->get(),
                'contacts' => Contact::latest()
                    ->take(5)
                    ->get(),
                'reports'  => Report::with(['user', 'booking'])
                    ->latest()
                    ->take(5)
                    ->get(),
            ];

            // Review Statistics
            $reviewStats = [
                'total'         => Review::count(),
                'averageRating' => Review::avg('rating'),
                'positive'      => Review::where('rating', '>=', 4)->count(),
            ];

            return view('backend.layouts.dashboard.index', compact(
                'userStats',
                'bookingStats',
                'serviceStats',
                'systemStats',
                'recentActivities',
                'reviewStats'
            ));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
