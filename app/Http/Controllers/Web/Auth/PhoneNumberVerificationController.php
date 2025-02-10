<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PhoneNumberVerificationController extends Controller {
    /**
     * Display the phone number verification view.
     *
     * @return View
     *
     */
    public function index(): View {
        return view('auth.layouts.verification-using-phone-number');
    }
}
