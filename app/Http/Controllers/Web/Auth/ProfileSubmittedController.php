<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\View\View;

class ProfileSubmittedController extends Controller {
    /**
     * Display the profile submitted page.
     *
     * @return View
     */
    public function __invoke(): View {
        // Fetching data using static methods from models
        $profileReviewMessage = CMS::profileReviewMessage();
        return view('auth.layouts.profile-submitted', compact('profileReviewMessage'));
    }
}
