<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BusinessInformation;
use App\Models\Review;
use App\Models\Service;
use App\Models\TravelRadius;
use App\Models\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BeautyExpertDashboardController extends Controller {
    /**
     * Display the beauty expert dashboard index page.
     *
     * @return View
     */
    public function index(): View {
        $user = Auth::user();

        // Fetch upcoming bookings where the beauty expert is assigned via user_service_id and payment is completed
        $upcomingBookings = Booking::whereHas('userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereHas('payments', function ($query) {
                $query->where('payment_status', 'completed');
            })
            ->with(['user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Convert service_ids to line-separated service names
        foreach ($upcomingBookings as $booking) {
            $serviceNames = [];
            if (!empty($booking->service_ids)) {
                $serviceIds   = explode(',', $booking->service_ids);
                $services     = Service::whereIn('id', $serviceIds)->pluck('services_name')->toArray();
                $serviceNames = $services;
            }
            $booking->servicesText = implode('<br>', $serviceNames);
        }

        // Fetch pending requests where payment is not completed
        $pendingRequests = Booking::whereHas('userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereDoesntHave('payments', function ($query) {
                $query->where('payment_status', 'completed');
            })
            ->with(['user', 'userService.service', 'payments'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Calculate average rating from reviews
        $averageRating = Review::whereHas('booking.userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'active') // Ensure only active reviews are considered
            ->avg('rating');

        // Count total number of reviews
        $reviewCount = Review::whereHas('booking.userService', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'active')
            ->count();

        // Pass availability status to the view
        $availability = $user->availability;

        return view('frontend.layouts.beauty_expert_dashboard.index', compact(
            'upcomingBookings',
            'pendingRequests',
            'averageRating',
            'reviewCount',
            'availability'
        ));
    }

    /**
     * Toggle the availability status of the beauty expert.
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function toggleAvailability(Request $request): JsonResponse {
        $user   = Auth::user();
        $status = $request->input('status') === 'available' ? 'available' : 'unavailable';

        // Update user's availability status
        $user->availability = $status;
        $user->save();

        // Update BusinessInformation
        BusinessInformation::where('user_id', $user->id)->update(['status' => $status === 'available' ? 'active' : 'inactive']);

        // Update TravelRadius
        TravelRadius::where('user_id', $user->id)->update(['status' => $status === 'available' ? 'active' : 'inactive']);

        // Update UserService
        UserService::where('user_id', $user->id)->update(['status' => $status === 'available' ? 'active' : 'inactive']);

        return response()->json(['status' => 'success']);
    }
}
