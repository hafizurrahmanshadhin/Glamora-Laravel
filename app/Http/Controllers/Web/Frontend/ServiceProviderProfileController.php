<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class ServiceProviderProfileController extends Controller {
    /**
     * Display the service provider profile page.
     *
     * @return View
     */
    public function index($userId): View {
        $user = User::with(['userServices.service'])->findOrFail($userId);

        return view('frontend.layouts.service_provider_profile.index', compact('user'));
    }
}
