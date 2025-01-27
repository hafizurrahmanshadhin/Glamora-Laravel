<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PaymentController extends Controller {
    /**
     * Display the payment form page.
     *
     * @return View
     */
    public function makePayment(): View {
        return view("frontend.layouts.payment.index");
    }
}
