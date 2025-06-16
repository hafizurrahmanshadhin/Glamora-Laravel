<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    /**
     * Display the notifications page.
     *
     * @param $id
     * @return JsonResponse | RedirectResponse
     */
    public function markAsRead($id): JsonResponse | RedirectResponse {
        try {
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
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Mark a notification as read via AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function markAsReadAjax(Request $request): JsonResponse {
        try {
            $notificationId = $request->input('notification_id');
            $notification   = Auth::user()->notifications()->findOrFail($notificationId);
            $notification->markAsRead();

            $updatedCount = Auth::user()->unreadNotifications()->count();
            return response()->json(['status' => 'success', 'unreadCount' => $updatedCount]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
