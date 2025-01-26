<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookServiceController extends Controller {
    /**
     * Display the booking form page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.booking.index');
    }

    public function store(Request $request) {
        $request->validate([
            'service_type'        => 'required|string',
            'appointment_date'    => 'required|date',
            'appointment_time'    => 'required|string',
            'service_provider_id' => 'required|integer',
        ]);

        $booking = Booking::create([
            'user_id'          => Auth::id(),
            'service_type'     => $request->service_type,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        // After storing:
        $serviceOwner = User::findOrFail($request->service_provider_id);
        // Only notify if the user is a “beauty_expert”, etc.:
        if ($serviceOwner->role === 'beauty_expert') {
            $serviceOwner->notify(new BookingNotification($booking));
        }

        return redirect()->back()->with('t-success', 'Booking created successfully.');
    }

    /**
     * Display the negotiated date and time page.
     *
     * @return View
     */
    public function viewNegotiate(): View {
        return view('frontend.layouts.negotiated_date_and_time.index');
    }
}
