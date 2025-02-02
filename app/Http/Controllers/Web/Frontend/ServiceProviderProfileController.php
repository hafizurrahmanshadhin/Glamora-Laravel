<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceProviderProfileController extends Controller {
    /**
     * Display the service provider profile page.
     *
     * @return View
     */
    public function index(Request $request, $userId, $serviceId): View {
        $user = User::with(['userServices.service'])->findOrFail($userId);

        $reviews = Review::whereHas('booking.userService', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['booking.userService'])->get();

        return view('frontend.layouts.service_provider_profile.index', compact('user', 'serviceId', 'reviews'));
    }
}
