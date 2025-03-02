<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class ResetController extends Controller {
    /**
     * Run Migrations and Seed the Database with Optimized Clear Cache
     *
     * @return JsonResponse
     */
    public function Reset(): JsonResponse {
        try {
            Artisan::call('optimize:clear');

            return Helper::jsonResponse(true, 'System Optimized Successfully', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An Error Occurred While Optimizing The System.', 500, ['error' => $e->getMessage()]);
        }
    }
}
