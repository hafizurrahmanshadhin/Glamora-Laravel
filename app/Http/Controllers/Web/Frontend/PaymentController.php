<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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

    public function checkout(Booking $booking) {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'price_data' => [
                    'currency'     => 'USD',
                    'product_data' => [
                        'name' => $booking->userService->service->services_name,
                    ],
                    'unit_amount'  => $booking->price * 100,
                ],
                'quantity'   => 1,
            ]],
            'mode'                 => 'payment',
            'success_url'          => route('payment.success', ['booking' => $booking->id]),
            'cancel_url'           => route('payment.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success(Booking $booking, Request $request) {
        // Store Payment Record
        Payment::create([
            'user_id'           => Auth::id(),
            'booking_id'        => $booking->id,
            'amount'            => $booking->price,
            'currency'          => 'USD',
            'payment_status'    => 'completed',
            'stripe_payment_id' => $request->get('session_id'),
        ]);

        // Store Order Record
        Order::create([
            'user_id'      => Auth::id(),
            'booking_id'   => $booking->id,
            'total_amount' => $booking->price,
            'status'       => 'paid',
        ]);

        return view('frontend.layouts.payment.booking-successful')->with('t-success', 'Payment successful!');
    }

    public function cancel() {
        return redirect()->route('beauty-expert-dashboard')->with('t-error', 'Payment cancelled.');
    }
}
