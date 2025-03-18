<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller {
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse | JsonResponse {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended(route('dashboard', absolute: false));
            }

            $request->user()->sendEmailVerificationNotification();

            return back()->with('status', 'verification-link-sent');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
