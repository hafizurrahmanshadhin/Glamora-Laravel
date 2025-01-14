<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserDashboardController extends Controller {
    /**
     * Display the user dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.user_dashboard.index');
    }
}
