<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BeautyExpertDashboardController extends Controller {
    /**
     * Display the beauty expert dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        $user = Auth::user();

        // Fetch upcoming bookings where the beauty expert is assigned via user_service_id and payment is completed
        $upcomingBookings = Booking::whereHas('userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereHas('payments', function ($query) {
                $query->where('payment_status', 'completed');
            })
            ->with(['user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Fetch pending requests where payment is not completed
        $pendingRequests = Booking::whereHas('userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereDoesntHave('payments', function ($query) {
                $query->where('payment_status', 'completed');
            })
            ->with(['user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Calculate average rating from reviews
        $averageRating = Review::whereHas('booking.userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'active') // Ensure only active reviews are considered
            ->avg('rating');

        // Count total number of reviews
        $reviewCount = Review::whereHas('booking.userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'active')
            ->count();

        return view('frontend.layouts.beauty_expert_dashboard.index', compact('upcomingBookings', 'pendingRequests', 'averageRating', 'reviewCount'));
    }
}
