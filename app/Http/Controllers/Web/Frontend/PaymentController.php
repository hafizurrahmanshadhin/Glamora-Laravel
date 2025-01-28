<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller {
    /**
     * Display the payment form page.
     *
     * @param Booking $booking
     * @return View|RedirectResponse
     */
    public function makePayment(Booking $booking) {
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('beauty-expert-dashboard')->with('t-error', 'Unauthorized access.');
        }

        // Load related user service
        $booking->load('userService.service');

        return view("frontend.layouts.payment.index", compact('booking'));
    }
}
