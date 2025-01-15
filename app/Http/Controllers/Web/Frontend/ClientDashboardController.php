<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ClientDashboardController extends Controller {
    /**
     * Display the client dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.client_dashboard.index');
    }
}
