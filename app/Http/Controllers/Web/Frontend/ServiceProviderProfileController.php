<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Models\UserTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Display the service provider profile edit page.
     *
     * @return View
     */
    public function editProfile(): View {
        $user   = Auth::user()->load('userServices.service');
        $userId = Auth::id();

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

        return view('frontend.layouts.beauty_expert_dashboard.profile', [
            'user'          => $user,
            'averageRating' => $averageRating,
            'reviewCount'   => $reviewCount,
            'reviews'       => $reviews,
        ]);
    }

    public function store(Request $request) {
        $request->validate(['tool_name' => 'required|string']);

        $tool = UserTool::create([
            'user_id'   => Auth::id(),
            'tool_name' => $request->tool_name,
        ]);

        // Use your Helper method for JSON responses
        return Helper::jsonResponse(true, 'Tool added successfully.', 201, $tool);
    }

    public function destroy(UserTool $tool) {
        if ($tool->user_id !== Auth::id()) {
            return Helper::jsonResponse(false, 'Unauthorized', 403);
        }

        $tool->delete();

        return Helper::jsonResponse(true, 'Tool deleted successfully.', 200);
    }
}
