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

        // Calculate this user’s average rating
        $avg = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->avg('rating') ?? 0;
        $averageRating = round($avg * 2) / 2;

        // Count total reviews for this user
        $reviewCount = Review::where('status', 'active')
            ->whereHas('booking.userService', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->count();

        $reviews = Review::whereHas('booking.userService', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['booking.userService'])->get();

        return view('frontend.layouts.service_provider_profile.index', [
            'user'          => $user,
            'serviceId'     => $serviceId,
            'reviews'       => $reviews,
            'averageRating' => $averageRating,
            'reviewCount'   => $reviewCount,
        ]);
    }
}
