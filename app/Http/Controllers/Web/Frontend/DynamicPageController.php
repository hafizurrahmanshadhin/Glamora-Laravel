<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\View\View;

class DynamicPageController extends Controller {
    /**
     * Display the specified resource.
     *
     * @param string $page_slug
     * @return View
     */
    public function index(string $page_slug): View {
        $pageData = DynamicPage::where('status', 'active')
            ->whereNull('deleted_at')
            ->where("page_slug", $page_slug)
            ->first();
        return view('frontend.layouts.dynamic_page.index', compact('pageData'));
    }
}
