<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller {
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index(): View {
        return view('backend.layouts.dashboard.index');
    }
}
