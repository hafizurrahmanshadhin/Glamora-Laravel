<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TermsAndConditionsController extends Controller {
    /**
     * Display the terms and conditions page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();
            return view('backend.layouts.settings.terms_and_conditions', compact('terms_and_conditions'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the terms and conditions.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();

            if ($terms_and_conditions) {
                $terms_and_conditions->title   = $request->input('title');
                $terms_and_conditions->slug    = Str::slug($request->input('title'));
                $terms_and_conditions->content = $request->input('content');
                $terms_and_conditions->save();
            } else {
                Content::create([
                    'type'    => 'termsAndConditions',
                    'title'   => $request->input('title'),
                    'slug'    => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }

            return back()->with('t-success', 'Terms & Conditions Updated Successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
