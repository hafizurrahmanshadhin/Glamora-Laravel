<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller {
    public function checkout(Request $request) {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'line_items'  => [[
                'price_data' => [
                    'currency'     => 'usd',
                    'product_data' => ['name' => 'Send me Money'],
                    'unit_amount'  => 100,
                ],
                'quantity'   => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success() {
        return view('frontend.layouts.user_dashboard.index');
    }

    public function cancel(): RedirectResponse {
        return redirect()->route('stripe.checkout')->with('t-error', 'Payment canceled.');
    }
}
