<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    public function markAsRead($id) {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();

        $bookingId = $notification->data['booking_id'] ?? null;
        if ($bookingId) {
            if (Auth::user()->role === 'client') {
                return redirect()->route('make-payment', ['booking' => $bookingId]);
            } else {
                return redirect()->route('negotiate-request', ['booking' => $bookingId]);
            }
        }
        return redirect()->back();
    }
}
