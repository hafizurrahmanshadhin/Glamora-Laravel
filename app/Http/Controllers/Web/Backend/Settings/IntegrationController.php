<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class IntegrationController extends Controller {
    /**
     * Display integration settings page.
     *
     * @return View
     */
    public function index(): View {
        return view('backend.layouts.settings.integration_settings');
    }

    /**
     * Update google credentials settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateGoogleCredentials(Request $request): RedirectResponse {
        $request->validate([
            'GOOGLE_CLIENT_ID'     => 'nullable|string',
            'GOOGLE_CLIENT_SECRET' => 'nullable|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/GOOGLE_CLIENT_ID=(.*)\s/',
                '/GOOGLE_CLIENT_SECRET=(.*)\s/',
            ], [
                'GOOGLE_CLIENT_ID=' . $request->GOOGLE_CLIENT_ID . $lineBreak,
                'GOOGLE_CLIENT_SECRET=' . $request->GOOGLE_CLIENT_SECRET . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            return redirect()->back()->with('t-success', 'Google Setting Update Successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Google Setting Update Failed');
        }
    }

    /**
     * Update facebook credentials settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateFacebookCredentials(Request $request): RedirectResponse {
        $request->validate([
            'FACEBOOK_CLIENT_ID'     => 'nullable|string',
            'FACEBOOK_CLIENT_SECRET' => 'nullable|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/FACEBOOK_CLIENT_ID=(.*)\s/',
                '/FACEBOOK_CLIENT_SECRET=(.*)\s/',
            ], [
                'FACEBOOK_CLIENT_ID=' . $request->FACEBOOK_CLIENT_ID . $lineBreak,
                'FACEBOOK_CLIENT_SECRET=' . $request->FACEBOOK_CLIENT_SECRET . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            return redirect()->back()->with('t-success', 'FACEBOOK Setting Update Successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'FACEBOOK Setting Update Failed');
        }
    }

    /**
     * Update stripe credentials settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateStripeCredentials(Request $request): RedirectResponse {
        $request->validate([
            'STRIPE_KEY'    => 'nullable|string',
            'STRIPE_SECRET' => 'nullable|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/STRIPE_KEY=(.*)\s/',
                '/STRIPE_SECRET=(.*)\s/',
            ], [
                'STRIPE_KEY=' . $request->STRIPE_KEY . $lineBreak,
                'STRIPE_SECRET=' . $request->STRIPE_SECRET . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            return redirect()->back()->with('t-success', 'Stripe Setting Update successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Stripe Setting Update Failed');
        }
    }
}
