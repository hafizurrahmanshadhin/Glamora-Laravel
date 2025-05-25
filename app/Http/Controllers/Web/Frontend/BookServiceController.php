<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingCancellationBeforeAppointment;
use App\Models\User;
use App\Models\UserService;
use App\Notifications\BookingNotification;
use App\Notifications\BookingStatusNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BookServiceController extends Controller {
    /**
     * Display the booking form page.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        try {
            $serviceProviderId = $request->query('service_provider_id');
            $serviceId         = $request->query('service_id');

            $serviceIdsParam = $request->query('service_ids');
            $serviceIds      = $serviceIdsParam ? explode(',', $serviceIdsParam) : [$serviceId];

            $userService = UserService::with('service')
                ->where('user_id', $serviceProviderId)
                ->where('service_id', $serviceId)
                ->firstOrFail();

            $price       = $userService->total_price;
            $serviceName = $userService->service->services_name;

            $selectedServices = UserService::with('service')
                ->where('user_id', $serviceProviderId)
                ->whereIn('service_id', $serviceIds)
                ->get();

            $totalPrice = $selectedServices->sum('total_price');

            $user = User::find($serviceProviderId);

            $unavailableRanges = [];
            if ($user && $user->unavailable_from && $user->unavailable_to) {
                $unavailableRanges[] = [
                    'from' => Carbon::parse($user->unavailable_from)->format('Y-m-d'),
                    'to'   => Carbon::parse($user->unavailable_to)->format('Y-m-d'),
                ];
            }

            return view('frontend.layouts.booking.index', compact(
                'serviceProviderId',
                'serviceId',
                'price',
                'serviceName',
                'selectedServices',
                'totalPrice',
                'serviceIds',
                'unavailableRanges'
            ));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'service_type'        => 'required|string',
                'appointment_date'    => 'required|date',
                'appointment_time'    => 'required|string',
                'service_provider_id' => 'required|integer',
                'service_id'          => 'required|integer',
                'total_price'         => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Fetch the UserService from user_services table
            $userService = UserService::where('user_id', $request->service_provider_id)
                ->where('service_id', $request->service_id)
                ->firstOrFail();

            // Use the total price from the request.
            $price = $request->total_price;

            // Create the booking with user_service_id
            $booking = Booking::create([
                'user_id'          => Auth::id(),
                'user_service_id'  => $userService->id,
                'service_ids'      => $request->input('service_ids'),
                'service_type'     => $request->service_type,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'price'            => $price,
            ]);

            // After storing: Only notify if the user is a “beauty_expert”.
            $serviceOwner = User::findOrFail($request->service_provider_id);
            if ($serviceOwner->role === 'beauty_expert') {
                $serviceOwner->notify(new BookingNotification($booking));
            }

            return redirect()->back()->with('t-success', 'Booking created successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create booking.');
        }
    }

    /**
     * Display the negotiated date and time page.
     *
     * @param Booking $booking
     * @return View|JsonResponse
     */
    public function viewNegotiate(Booking $booking): View | JsonResponse {
        try {
            // Convert stored service_ids to an array of integers.
            $serviceIds = $booking->service_ids ? array_map('intval', explode(',', $booking->service_ids)) : [];

            // Retrieve the service provider ID from the related userService record.
            $serviceProviderId = $booking->userService->user_id;

            // Fetch all selected UserService records with related service info.
            $selectedServices = UserService::with('service')
                ->where('user_id', $serviceProviderId)
                ->whereIn('service_id', $serviceIds)
                ->get();

            return view('frontend.layouts.negotiated_date_and_time.index', [
                'booking'          => $booking,
                'selectedServices' => $selectedServices,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Respond to the availability request.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function respondAvailability(Request $request): RedirectResponse | JsonResponse {
        try {
            $booking = Booking::where('id', $request->booking_id)->firstOrFail();
            $client  = $booking->user;

            switch ($request->action_type) {
            case 'cancel':
                BookingCancellationBeforeAppointment::create([
                    'booking_id'   => $booking->id,
                    'canceled_by'  => Auth::id(), // The user performing the cancel
                    'requested_by' => $client->id, // The original booking request's user
                ]);

                // Notify client that the request is declined
                $client->notify(new BookingStatusNotification(
                    $booking,
                    "Declined your request!"
                ));
                return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Booking request declined.');

            case 'yes':
                // “I’m Available” - pass existing date/time/price
                $formattedDate = Carbon::parse($booking->appointment_date)->format('Y-m-d');
                $formattedTime = $booking->appointment_time
                ? Carbon::parse($booking->appointment_time)->format('h:i A')
                : 'No time set';

                $client->notify(new BookingStatusNotification(
                    $booking,
                    "I’m Available with Date: $formattedDate, Time: $formattedTime, Price: $booking->price"
                ));
                return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Availability confirmed.');

            case 'offer':
                // Update booking record with new offer details
                $booking->update([
                    'appointment_date' => $request->new_date,
                    'appointment_time' => $request->new_time,
                    'price'            => $request->new_price,
                ]);

                $formattedDate = Carbon::parse($booking->appointment_date)->format('Y-m-d');
                $formattedTime = $booking->appointment_time
                ? Carbon::parse($booking->appointment_time)->format('h:i A')
                : 'No time set';

                $client->notify(new BookingStatusNotification(
                    $booking,
                    "New Offer! Date: $formattedDate, Time: $formattedTime, Price: $booking->price"
                ));
                return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Offer sent.');

            default:
                return redirect()->route('beauty-expert-dashboard')->with('t-error', 'Invalid action.');
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
