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

class PrivacyPolicyController extends Controller {
    /**
     * Display the privacy policy page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $privacy_policy = Content::where('type', 'privacyPolicy')->first();
            return view('backend.layouts.settings.privacy_policy', compact('privacy_policy'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the privacy policy.
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
            $privacy_policy = Content::where('type', 'privacyPolicy')->first();

            if ($privacy_policy) {
                $privacy_policy->title   = $request->input('title');
                $privacy_policy->slug    = Str::slug($request->input('title'));
                $privacy_policy->content = $request->input('content');
                $privacy_policy->save();
            } else {
                Content::create([
                    'type'    => 'privacyPolicy',
                    'title'   => $request->input('title'),
                    'slug'    => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }

            return back()->with('t-success', 'Privacy Policy Updated Successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
