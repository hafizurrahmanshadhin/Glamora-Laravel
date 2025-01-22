<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserService;
use Illuminate\View\View;

class AvailableServicesController extends Controller {
    /**
     * Display the available beauty services page.
     *
     * @return View
     */
    public function index($serviceId): View {
        $query = UserService::where('status', 'active')
            ->with(['service', 'user']);

        // Filter by service_id if provided
        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }

        // Retrieve & map for the styler count
        $approvedServices = $query->get()->map(function ($userService) {
            $stylerCount = UserService::where('service_id', $userService->service_id)
                ->where('status', 'active')
                ->distinct('user_id')
                ->count();

            $userService->styler_count = $stylerCount;
            return $userService;
        });

        return view('frontend.layouts.available_services.index', compact('approvedServices'));
    }
}
