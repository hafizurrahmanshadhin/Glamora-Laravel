<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use Exception;
use App\Models\Content;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class TermsAndConditionsController extends Controller
{
    /**
     * Display the terms and conditions page.
     *
     * @return View
     */
    public function index(): View {
        $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();
        return view('backend.layouts.settings.terms_and_conditions', compact('terms_and_conditions'));
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
                $terms_and_conditions->title = $request->input('title');
                $terms_and_conditions->slug = Str::slug($request->input('title'));
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
