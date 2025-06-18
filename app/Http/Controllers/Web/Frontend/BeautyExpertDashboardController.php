<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingCancellationAfterAppointment;
use App\Models\BusinessInformation;
use App\Models\CMS;
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
                ->where('status', 'active')
                ->avg('rating');

            // Count total number of reviews
            $reviewCount = Review::whereHas('booking.userService', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->where('status', 'active')
                ->count();

            // Pass availability status to the view
            $availability = $user->availability;

            // Fetch unavailable date ranges
            $unavailableRanges = [];
            if (!empty($user->unavailable_ranges)) {
                foreach ($user->unavailable_ranges as $range) {
                    $unavailableRanges[] = [
                        'from' => Carbon::createFromFormat('d/m/Y', $range['from_date'])->format('Y-m-d'),
                        'to'   => Carbon::createFromFormat('d/m/Y', $range['to_date'])->format('Y-m-d'),
                    ];
                }
            }

            $highlightDates = $upcomingBookings->map(function ($booking) {
                return Carbon::parse($booking->appointment_date)->format('Y-m-d');
            })->unique()->values()->all();

            // Fetching data using static methods from models
            $userDashboardContent = CMS::userDashboard();

            return view('frontend.layouts.beauty_expert_dashboard.index', compact(
                'user',
                'upcomingBookings',
                'pendingRequests',
                'averageRating',
                'reviewCount',
                'availability',
                'unavailableRanges',
                'highlightDates',
                'userDashboardContent'
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
     * @throws Exception
     */
    public function toggleAvailability(Request $request): JsonResponse {
        try {
            $user          = Auth::user();
            $relatedStatus = 'active'; // Initialize with default value

            if ($request->input('status') === 'available') {
                // Clear all unavailability data
                $user->availability       = 'available';
                $user->unavailable_ranges = null;
                $relatedStatus            = 'active';
            } elseif ($request->input('status') === 'unavailable') {
                if ($request->has('ranges') && is_array($request->input('ranges')) && count($request->input('ranges')) > 0) {
                    $user->unavailable_ranges = $request->input('ranges');

                    // Check if current date falls within any of the ranges
                    $currentDate         = Carbon::now()->format('Y-m-d');
                    $shouldBeUnavailable = false;

                    foreach ($request->input('ranges') as $range) {
                        if (isset($range['from_date']) && isset($range['to_date'])) {
                            try {
                                $fromDate = Carbon::createFromFormat('d/m/Y', $range['from_date'])->format('Y-m-d');
                                $toDate   = Carbon::createFromFormat('d/m/Y', $range['to_date'])->format('Y-m-d');

                                if ($currentDate >= $fromDate && $currentDate <= $toDate) {
                                    $shouldBeUnavailable = true;
                                    break;
                                }
                            } catch (Exception $dateException) {
                                // Invalid date format, skip this range
                                continue;
                            }
                        }
                    }

                    $user->availability = $shouldBeUnavailable ? 'unavailable' : 'available';
                    $relatedStatus      = $shouldBeUnavailable ? 'inactive' : 'active';
                } else {
                    // No valid ranges provided, treat as available
                    $user->availability       = 'available';
                    $user->unavailable_ranges = null;
                    $relatedStatus            = 'active';
                }
            }

            $user->save();

            // Update related models based on current availability
            BusinessInformation::where('user_id', $user->id)->update(['status' => $relatedStatus]);
            TravelRadius::where('user_id', $user->id)->update(['status' => $relatedStatus]);
            UserService::where('user_id', $user->id)->update(['status' => $relatedStatus]);

            return response()->json([
                'status'               => 'success',
                'current_availability' => $user->availability,
                'message'              => 'Availability updated successfully',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred while updating availability',
            ], 500);
        }
    }

    /**
     * Delete a specific unavailable range by index.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUnavailableRange(Request $request): JsonResponse {
        try {
            $user          = Auth::user();
            $indexToDelete = $request->input('index');

            if (!is_numeric($indexToDelete) || empty($user->unavailable_ranges)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid range index'], 400);
            }

            $ranges = $user->unavailable_ranges;

            // Check if index exists
            if (!isset($ranges[$indexToDelete])) {
                return response()->json(['status' => 'error', 'message' => 'Range not found'], 404);
            }

            // Remove the range at the specified index
            unset($ranges[$indexToDelete]);

            // Reindex the array to maintain proper indexing
            $ranges = array_values($ranges);

            // Update user
            $user->unavailable_ranges = empty($ranges) ? null : $ranges;
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Range deleted successfully']);

        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store the weekend data for the beauty expert.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeWeekendData(Request $request): JsonResponse {
        try {
            $user               = Auth::user();
            $weekendData        = $request->input('weekend_data');
            $user->weekend_data = $weekendData;
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Weekend data updated']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
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
            $booking     = Booking::findOrFail($request->booking_id);
            $canceledBy  = Auth::id() ?? null;
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

    /**
     * Get booking details by date.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getBookingDetailsByDate(Request $request) {
        try {
            $date = $request->query('date');

            $bookings = Booking::whereDate('appointment_date', $date)
                ->whereHas('userService', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->whereHas('payments', function ($query) {
                    $query->where('payment_status', 'completed');
                })
                ->whereDoesntHave('bookingCancellationAfterAppointments')
                ->with(['user', 'userService.service'])
                ->get();

            // Convert service_ids to line-separated service names
            foreach ($bookings as $booking) {
                if (!empty($booking->service_ids)) {
                    $serviceIds             = explode(',', $booking->service_ids);
                    $services               = Service::whereIn('id', $serviceIds)->pluck('services_name')->toArray();
                    $booking->services_text = implode('<br>', $services);
                } else {
                    $booking->services_text = "N/A";
                }
            }

            return response()->json(['status' => true, 'bookings' => $bookings]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
