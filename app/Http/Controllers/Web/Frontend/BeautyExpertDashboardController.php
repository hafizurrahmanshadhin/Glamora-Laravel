<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingCancellationAfterAppointment;
use App\Models\BusinessInformation;
use App\Models\Review;
use App\Models\Service;
use App\Models\TravelRadius;
use App\Models\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BeautyExpertDashboardController extends Controller {
    /**
     * Display the beauty expert dashboard index page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $user = Auth::user();

            // Fetch upcoming bookings where the beauty expert is assigned via user_service_id and payment is completed
            $upcomingBookings = Booking::whereHas('userService', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->whereHas('payments', function ($query) {
                    $query->where('payment_status', 'completed');
                })
                ->whereDoesntHave('bookingCancellationAfterAppointments')
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
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the availability status of the beauty expert.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function toggleAvailability(Request $request): JsonResponse {
        try {
            $user   = Auth::user();
            $status = $request->input('status') === 'available' ? 'available' : 'unavailable';

            // always set availability
            $user->availability = $status;

            // if going unavailable, record the date window
            if ($status === 'unavailable'
                && $request->filled('from_date')
                && $request->filled('to_date')) {
                // parse your d/m/y format
                $user->unavailable_from = Carbon::createFromFormat('d/m/y', $request->input('from_date'))
                    ->startOfDay();
                $user->unavailable_to = Carbon::createFromFormat('d/m/y', $request->input('to_date'))
                    ->endOfDay();
            } else {
                // clear any prior window
                $user->unavailable_from = null;
                $user->unavailable_to   = null;
            }

            $user->save();

            $relatedStatus = $status === 'available' ? 'active' : 'inactive';
            BusinessInformation::where('user_id', $user->id)->update(['status' => $relatedStatus]);
            TravelRadius::where('user_id', $user->id)->update(['status' => $relatedStatus]);
            UserService::where('user_id', $user->id)->update(['status' => $relatedStatus]);

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Cancel a booking after appointments have been made.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bookingCancellationAfterAppointments(Request $request): JsonResponse {
        $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        try {
            // Find the booking to cancel
            $booking = Booking::findOrFail($request->booking_id);

            // The currently logged-in user is “canceling_by”
            $canceledBy = Auth::id() ?? null;
            // The “requested_by” from the original booking (or any logic you prefer)
            $requestedBy = $booking->user_id ?? null;

            BookingCancellationAfterAppointment::create([
                'booking_id'   => $booking->id,
                'canceled_by'  => $canceledBy,
                'requested_by' => $requestedBy,
            ]);

            return Helper::jsonResponse(true, 'Appointment canceled successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to cancel appointment', 500, null, $e->getMessage());
        }
    }
}
