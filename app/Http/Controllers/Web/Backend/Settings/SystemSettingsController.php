<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SystemSettingsController extends Controller {
    /**
     * Display the system settings page.
     *
     * @return View
     */
    public function index(): View {
        $setting = SystemSetting::latest('id')->first();
        return view('backend.layouts.settings.system_settings', compact('setting'));
    }

    /**
     * Update the system settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'title'          => 'nullable|string',
            'system_name'    => 'nullable|string',
            'email'          => 'nullable|string|email',
            'phone_number'   => 'nullable|string|max:25',
            'address'        => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'description'    => 'nullable|string',
            'logo'           => 'nullable',
            'favicon'        => 'nullable',
            'remove_logo'    => 'nullable|boolean',
            'remove_favicon' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $setting = SystemSetting::firstOrNew();

            $setting->title          = $request->title;
            $setting->system_name    = $request->system_name;
            $setting->email          = $request->email;
            $setting->phone_number   = $request->phone_number;
            $setting->address        = $request->address;
            $setting->copyright_text = $request->copyright_text;
            $setting->description    = $request->description;

            //* Handle logo file
            if ($request->boolean('remove_logo')) {
                if ($setting->logo) {
                    Helper::fileDelete(public_path($setting->logo));
                    $setting->logo = null;
                }
            } elseif ($request->hasFile('logo')) {
                if ($setting->logo) {
                    Helper::fileDelete(public_path($setting->logo));
                }
                $setting->logo = Helper::fileUpload($request->file('logo'), 'logo', $setting->logo);
            }

            //* Handle favicon file
            if ($request->boolean('remove_favicon')) {
                if ($setting->favicon) {
                    Helper::fileDelete(public_path($setting->favicon));
                    $setting->favicon = null;
                }
            } elseif ($request->hasFile('favicon')) {
                if ($setting->favicon) {
                    Helper::fileDelete(public_path($setting->favicon));
                }
                $setting->favicon = Helper::fileUpload($request->file('favicon'), 'favicon', $setting->favicon);
            }

            $setting->save();
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
