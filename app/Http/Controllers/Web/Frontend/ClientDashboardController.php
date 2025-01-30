<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientDashboardController extends Controller {
    /**
     * Display the client dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        $user = Auth::user();

        $upcomingBookings = Booking::where('user_id', $user->id)
            ->whereHas('payments', function ($q) {
                $q->where('payment_status', 'completed');
            })
            ->with(['userService.user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        $pendingRequests = Booking::where('user_id', $user->id)
            ->whereDoesntHave('payments', function ($q) {
                $q->where('payment_status', 'completed');
            })
            ->with(['userService.user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('frontend.layouts.client_dashboard.index', compact('upcomingBookings', 'pendingRequests'));
    }
}
