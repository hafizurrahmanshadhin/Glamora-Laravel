<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EmailVerificationController extends Controller {
    /**
     * Display the email verification view.
     *
     * @return View
     *
     */
    public function index(): View {
        return view('auth.layouts.verification-using-email');
    }
    
}
