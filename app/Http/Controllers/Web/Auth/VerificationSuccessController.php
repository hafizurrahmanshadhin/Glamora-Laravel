<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class VerificationSuccessController extends Controller {
    /**
     * Display the email verification view.
     *
     * @return View
     *
     */
    public function index(): View {
        return view('auth.layouts.success');
    }
}
