<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BeautyExpertDashboardController extends Controller {
    /**
     * Display the beauty expert dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.beauty_expert_dashboard.index');
    }
}
