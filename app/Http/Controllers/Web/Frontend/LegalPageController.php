<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LegalPageController extends Controller {
    /**
     * Display the terms and conditions page.
     *
     * @return View
     */
    public function termsAndConditions(): View | JsonResponse {
        try {
            $termsAndConditions = Content::where('type', 'termsAndConditions')->first();
            return view('frontend.layouts.terms_and_conditions.index', compact('termsAndConditions'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the privacy policy page.
     *
     * @return View
     */
    public function privacyPolicy(): View | JsonResponse {
        try {
            $privacyPolicy = Content::where('type', 'privacyPolicy')->first();
            return view('frontend.layouts.privacy_policy.index', compact('privacyPolicy'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the refund policy page.
     *
     * @return View
     */
    public function inclusionsCancellation(): View | JsonResponse {
        try {
            $inclusionsCancellation = Content::where('type', 'inclusionsCancellation')->first();
            return view('frontend.layouts.inclusions_cancellation.index', compact('inclusionsCancellation'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
