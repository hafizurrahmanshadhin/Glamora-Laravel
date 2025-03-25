<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FAQController extends Controller {
    /**
     * Display the faq page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $faqs = FAQ::where('status', 'active')->whereNull('deleted_at')->get();

            return view('frontend.layouts.faq.index', compact('faqs'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
