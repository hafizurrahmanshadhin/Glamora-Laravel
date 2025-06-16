<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserDashboardController extends Controller {
    /**
     * Display the user-dashboard Section of the CMS.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $userDashboard = CMS::firstOrNew(['section' => 'user-dashboard']);
            return view('backend.layouts.cms.user-dashboard.index', compact('userDashboard'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the user-dashboard section.
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

            $joinUs              = CMS::firstOrNew(['section' => 'user-dashboard']);
            $joinUs->description = $request->input('description');
            $joinUs->section     = 'user-dashboard';
            $joinUs->save();

            return redirect()->route('cms.user-dashboard.index')->with('t-success', 'User dashboard updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
