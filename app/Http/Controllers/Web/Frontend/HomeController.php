<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the index page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.index.index');
    }
}
