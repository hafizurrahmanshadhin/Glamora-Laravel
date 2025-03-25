<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DynamicPageController extends Controller {
    /**
     * Display the specified resource.
     *
     * @param string $page_slug
     * @return View|JsonResponse
     */
    public function index(string $page_slug): View | JsonResponse {
        try {
            $pageData = DynamicPage::where('status', 'active')
                ->whereNull('deleted_at')
                ->where("page_slug", $page_slug)
                ->first();
            return view('frontend.layouts.dynamic_page.index', compact('pageData'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
