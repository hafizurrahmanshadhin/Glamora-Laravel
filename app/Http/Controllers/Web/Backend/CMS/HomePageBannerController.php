<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomePageBannerController extends Controller {
    /**
     * Display the home-page-banner Section of the CMS.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $homePageBanner = CMS::firstOrNew(['section' => 'home-page-banner']);
            return view('backend.layouts.cms.home-page-banner.index', compact('homePageBanner'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the home-page-banner section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $homePageBanner              = CMS::firstOrNew(['section' => 'home-page-banner']);
            $homePageBanner->description = $request->input('description');
            $homePageBanner->section     = 'home-page-banner';
            $homePageBanner->save();

            return redirect()->route('cms.home-page-banner.index')->with('t-success', 'Home page banner updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
