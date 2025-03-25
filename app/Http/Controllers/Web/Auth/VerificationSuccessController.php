<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class VerificationSuccessController extends Controller {
    /**
     * Display the email verification view.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            return view('auth.layouts.success');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
