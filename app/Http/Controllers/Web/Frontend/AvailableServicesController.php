<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AvailableServicesController extends Controller {
    /**
     * Display the available beauty services page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.available_services.index');
    }
}
