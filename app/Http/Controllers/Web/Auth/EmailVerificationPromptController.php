<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller {
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse | View | JsonResponse {
        try {
            return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute : false))
            : view('auth.verify-email');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
