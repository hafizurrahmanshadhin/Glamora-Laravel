<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class JoinUsController extends Controller {
    /**
     * Display the Join Us Section of the CMS.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $joinUs = CMS::firstOrNew(['section' => 'join_us']);
            return view('backend.layouts.cms.join-us.index', compact('joinUs'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'required|string',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $joinUs              = CMS::firstOrNew(['section' => 'join_us']);
            $joinUs->title       = $request->input('title');
            $joinUs->description = $request->input('description');
            $joinUs->section     = 'join_us';
            $joinUs->save();

            return redirect()->route('cms.join-us.index')->with('t-success', 'Join us updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
