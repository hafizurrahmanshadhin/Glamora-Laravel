<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class JoinController extends Controller {
    /**
     * Display the join page.
     *
     * @return View|JsonResponse
     */
    public function __invoke(): View | JsonResponse {
        try {
            $systemSetting = SystemSetting::first();
            return view('auth.layouts.join', compact('systemSetting'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
