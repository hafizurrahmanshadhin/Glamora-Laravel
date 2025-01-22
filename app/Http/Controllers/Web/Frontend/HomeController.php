<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserService;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the home page.
     *
     * @return View
     */
    public function index(): View {
        $approvedServices = UserService::where('status', 'active')
            ->with('service')
            ->get()
            ->map(function ($userService) {
                $stylerCount = UserService::where('service_id', $userService->service_id)
                    ->where('status', 'active')
                    ->distinct('user_id')
                    ->count();

                $userService->styler_count = $stylerCount;

                return $userService;
            });

        return view('frontend.layouts.home.index', compact('approvedServices'));
    }
}
