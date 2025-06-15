<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Service;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ServiceCategoryController extends Controller {
    /**
     * Display the service category page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $services      = Service::withCount('userServices')->where('status', 'active')->get();
            $joinUs        = CMS::joinUs();
            $systemSetting = SystemSetting::current();
            return view('frontend.layouts.service_category.index', compact('services', 'joinUs', 'systemSetting'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
