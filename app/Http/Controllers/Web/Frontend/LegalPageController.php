<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\View\View;

class LegalPageController extends Controller {
    /**
     * Display the terms and conditions page.
     *
     * @return View
     */
    public function termsAndConditions(): View {
        $termsAndConditions = Content::where('type', 'termsAndConditions')->first();
        return view('frontend.layouts.terms_and_conditions.index', compact('termsAndConditions'));
    }

    /**
     * Display the privacy policy page.
     *
     * @return View
     */
    public function privacyPolicy(): View {
        $privacyPolicy = Content::where('type', 'privacyPolicy')->first();
        return view('frontend.layouts.privacy_policy.index', compact('privacyPolicy'));
    }

    /**
     * Display the refund policy page.
     *
     * @return View
     */
    public function inclusionsCancellation(): View {
        $inclusionsCancellation = Content::where('type', 'inclusionsCancellation')->first();
        return view('frontend.layouts.inclusions_cancellation.index', compact('inclusionsCancellation'));
    }
}
