<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
            ->with([
                'userService.user',
                'userService.service',
                'payments',
                'user',
            ])
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('frontend.layouts.beauty_expert_dashboard.index', compact('upcomingBookings'));
    }
}
