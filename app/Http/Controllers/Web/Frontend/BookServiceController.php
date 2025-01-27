<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\UserService;
use App\Notifications\BookingNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookServiceController extends Controller {
    /**
     * Display the booking form page.
     *
     * @return View
     */
    public function index(Request $request): View {
        $serviceProviderId = $request->query('service_provider_id');
        $serviceId         = $request->query('service_id');
        return view('frontend.layouts.booking.index', compact('serviceProviderId', 'serviceId'));
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'service_type'        => 'required|string',
                'appointment_date'    => 'required|date',
                'appointment_time'    => 'required|string',
                'service_provider_id' => 'required|integer',
                'service_id'          => 'required|integer',
            ]);

            // Fetch the total_price from user_services table
            $userService = UserService::where('user_id', $request->service_provider_id)
                ->where('service_id', $request->service_id)
                ->firstOrFail();

            $booking = Booking::create([
                'user_id'          => Auth::id(),
                'service_type'     => $request->service_type,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'price'            => $userService->total_price,
            ]);

            // After storing: Only notify if the user is a “beauty_expert”.
            $serviceOwner = User::findOrFail($request->service_provider_id);
            if ($serviceOwner->role === 'beauty_expert') {
                $serviceOwner->notify(new BookingNotification($booking));
            }

            return redirect()->back()->with('t-success', 'Booking created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create booking.');
        }
    }

    /**
     * Display the negotiated date and time page.
     *
     * @return View
     */
    public function viewNegotiate(Booking $booking): View {
        return view('frontend.layouts.negotiated_date_and_time.index', compact('booking'));
    }
}
