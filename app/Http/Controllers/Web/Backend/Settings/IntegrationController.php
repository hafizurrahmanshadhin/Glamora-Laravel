<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

            Artisan::call('optimize:clear');

            return redirect()->route('integration.setting')
                ->with('t-success', 'Stripe Setting Update successfully.')
                ->with('activeTab', 'stripe');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Stripe Setting Update Failed');
        }
    }

    /**
     * Update twilio credentials settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateTwilioCredentials(Request $request): RedirectResponse {
        $request->validate([
            'TWILIO_SID'          => 'required|string',
            'TWILIO_AUTH_TOKEN'   => 'required|string',
            'TWILIO_PHONE_NUMBER' => 'required|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";
            $envContent = preg_replace([
                '/TWILIO_SID=(.*)\s/',
                '/TWILIO_AUTH_TOKEN=(.*)\s/',
                '/TWILIO_PHONE_NUMBER=(.*)\s/',
            ], [
                'TWILIO_SID=' . $request->TWILIO_SID . $lineBreak,
                'TWILIO_AUTH_TOKEN=' . $request->TWILIO_AUTH_TOKEN . $lineBreak,
                'TWILIO_PHONE_NUMBER=' . $request->TWILIO_PHONE_NUMBER . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
                Artisan::call('optimize:clear');
            }
            return redirect()->back()->with('t-success', 'Twilio Setting Update successfully.');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Twilio Setting Update Failed');
        }
    }
}
