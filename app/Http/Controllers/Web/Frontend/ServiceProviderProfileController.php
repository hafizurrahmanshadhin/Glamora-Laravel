<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServiceProviderProfileController extends Controller {
    /**
     * Display the service provider profile page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.service_provider_profile.index');
    }
}
