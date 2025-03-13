<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Report;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        // Attach formatted service names to each booking
        foreach ($upcomingBookings as $booking) {
            $serviceNames = [];
            if (!empty($booking->service_ids)) {
                $serviceIds = explode(',', $booking->service_ids);
                $services   = Service::whereIn('id', $serviceIds)
                    ->pluck('services_name')
                    ->toArray();
                $serviceNames = $services;
            }
            $booking->servicesText = implode('<br>', $serviceNames);
        }

        $pendingRequests = Booking::where('user_id', $user->id)
            ->whereDoesntHave('payments', function ($q) {
                $q->where('payment_status', 'completed');
            })
            ->whereDoesntHave('bookingCancellationBeforeAppointments')
            ->with(['userService.user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Attach formatted service names for each pending booking
        foreach ($pendingRequests as $booking) {
            $serviceNames = [];
            if (!empty($booking->service_ids)) {
                $serviceIds   = explode(',', $booking->service_ids);
                $services     = Service::whereIn('id', $serviceIds)->pluck('services_name')->toArray();
                $serviceNames = $services;
            }
            $booking->servicesText = implode('<br>', $serviceNames);
        }

        return view('frontend.layouts.client_dashboard.index', compact('upcomingBookings', 'pendingRequests'));
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function storeReview(Request $request): RedirectResponse {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'review'     => 'required|string',
            'rating'     => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id'    => Auth::id(),
            'booking_id' => $request->booking_id,
            'review'     => $request->review,
            'rating'     => $request->rating,
        ]);

        return redirect()->back()->with('t-success', 'Review submitted successfully.');
    }

    /**
     * Store a newly created report in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function storeReport(Request $request): RedirectResponse {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'message'    => 'required|string',
        ]);

        Report::create([
            'user_id'    => Auth::id(),
            'booking_id' => $request->booking_id,
            'message'    => $request->message,
        ]);

        return redirect()->back()->with('t-success', 'Report submitted successfully.');
    }
}
