<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Report;
use App\Models\Review;
use App\Models\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientDashboardController extends Controller {
    /**
     * Display the client dashboard index page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $user = Auth::user();

            $upcomingBookings = Booking::where('user_id', $user->id)
                ->whereHas('payments', function ($q) {
                    $q->where('payment_status', 'completed');
                })
                ->whereDoesntHave('bookingCancellationAfterAppointments')
                ->with(['userService.user', 'userService.service', 'payments'])
                ->orderBy('appointment_date', 'asc')
                ->get();

            // Attach formatted service names to each booking
            foreach ($upcomingBookings as $booking) {
                $serviceNames = [];
                if (!empty($booking->service_ids)) {
                    $serviceIds = explode(',', $booking->service_ids);
                    $services   = Service::whereIn('id', $serviceIds)
                        ->pluck('services_name')
                        ->toArray();
                    $serviceNames = $services;
                }
                $booking->servicesText = implode('<br>', $serviceNames);
            }

            $pendingRequests = Booking::where('user_id', $user->id)
                ->whereDoesntHave('payments', function ($q) {
                    $q->where('payment_status', 'completed');
                })
                ->whereDoesntHave('bookingCancellationBeforeAppointments')
                ->with(['userService.user', 'userService.service', 'payments'])
                ->orderBy('appointment_date', 'asc')
                ->get();

            // Attach formatted service names for each pending booking
            foreach ($pendingRequests as $booking) {
                $serviceNames = [];
                if (!empty($booking->service_ids)) {
                    $serviceIds   = explode(',', $booking->service_ids);
                    $services     = Service::whereIn('id', $serviceIds)->pluck('services_name')->toArray();
                    $serviceNames = $services;
                }
                $booking->servicesText = implode('<br>', $serviceNames);
            }

            return view('frontend.layouts.client_dashboard.index', compact('upcomingBookings', 'pendingRequests'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created review in storage.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function storeReview(Request $request): RedirectResponse | JsonResponse {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'review'     => 'required|string',
                'rating'     => 'required|integer|min:1|max:5',
            ]);

            Review::create([
                'user_id'    => Auth::id(),
                'booking_id' => $request->booking_id,
                'review'     => $request->review,
                'rating'     => $request->rating,
            ]);

            // After review is stored, delete the booking
            $booking = Booking::where('id', $request->booking_id)
                ->where('user_id', Auth::id())
                ->whereHas('payments', function ($q) {
                    $q->where('payment_status', 'completed');
                })
                ->whereDoesntHave('bookingCancellationAfterAppointments')
                ->first();

            // If not found under “Upcoming,” skip deletion
            if (!$booking) {
                return redirect()->back()
                    ->with('t-error', 'This booking is not in Upcoming Appointments (cannot remove).');
            }

            $booking->delete();

            return redirect()->back()->with('t-success', 'Thank you! Review submitted successfully and Booking Removed.');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created report in storage.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function storeReport(Request $request): RedirectResponse | JsonResponse {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'message'    => 'required|string',
            ]);

            Report::create([
                'user_id'    => Auth::id(),
                'booking_id' => $request->booking_id,
                'message'    => $request->message,
            ]);

            return redirect()->back()->with('t-success', 'Report submitted successfully.');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Cancel a booking (client initiated cancellation).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function cancelBooking(Request $request): JsonResponse {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
            ]);

            try {
                $booking = Booking::findOrFail($request->booking_id);
                $booking->delete();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Booking cancelled successfully.',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Failed to cancel booking.',
                    'error'   => $e->getMessage(),
                ], 500);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
