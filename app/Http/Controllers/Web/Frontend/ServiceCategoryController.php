<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServiceCategoryController extends Controller {
    /**
     * Display the service category page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.service_category.index');
    }
}
