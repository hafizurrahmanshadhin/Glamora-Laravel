<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Content;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LegalPageController extends Controller {
    /**
     * Display the terms and conditions page.
     *
     * @return View|JsonResponse
     */
    public function termsAndConditions(): View | JsonResponse {
        try {
            $termsAndConditions = Content::where('type', 'termsAndConditions')->first();
            $joinUs             = CMS::joinUs();
            return view('frontend.layouts.terms_and_conditions.index', compact('termsAndConditions', 'joinUs'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the privacy policy page.
     *
     * @return View|JsonResponse
     */
    public function privacyPolicy(): View | JsonResponse {
        try {
            $privacyPolicy = Content::where('type', 'privacyPolicy')->first();
            $joinUs        = CMS::joinUs();
            return view('frontend.layouts.privacy_policy.index', compact('privacyPolicy', 'joinUs'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the refund policy page.
     *
     * @return View|JsonResponse
     */
    public function inclusionsCancellation(): View | JsonResponse {
        try {
            $inclusionsCancellation = Content::where('type', 'inclusionsCancellation')->first();
            $joinUs                 = CMS::joinUs();
            return view('frontend.layouts.inclusions_cancellation.index', compact('inclusionsCancellation', 'joinUs'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
