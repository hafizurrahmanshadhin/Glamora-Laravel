<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\CMSImage;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Twilio\Rest\Client;

class PhoneNumberVerificationController extends Controller {
    /**
     * Display the phone number verification view.
     *
     * @return View
     */
    public function index() {
        $authBanner = CMSImage::where('page', 'auth')
            ->where('status', 'active')
            ->first();

        return view('auth.layouts.verification-using-phone-number', compact('authBanner'));
    }

    /**
     * Handle sending the OTP to the user's phone number via SMS.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function sendOtpToPhone(Request $request) {
        // Validate the phone number (adjust the regex as needed)
        $request->validate([
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,3}\)?[\s-]?)?[\d\s-]{7,15}$/',
            ],
        ]);

        $phoneNumber = $request->input('phone_number');

        // Generate a 4-digit OTP (with leading zeros if needed)
        $otp = sprintf("%04d", rand(0, 9999));

        // Send the OTP via SMS using Twilio
        $sid   = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from  = env('TWILIO_PHONE_NUMBER');

        if (!$sid || !$token || !$from) {
            return redirect()->back()
                ->withErrors(['phone_number' => 'SMS service is not properly configured.']);
        }

        try {
            $client = new Client($sid, $token);
            $client->messages->create($phoneNumber, [
                'body' => "Your OTP is: {$otp}",
                'from' => $from,
            ]);
        } catch (Exception $e) {
            Log::error("Twilio error: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['phone_number' => 'Failed to send SMS: ' . $e->getMessage()]);
        }

        // Save or update the OTP record in the password_resets table
        PasswordReset::updateOrCreate(
            ['phone_number' => $phoneNumber],
            ['otp' => $otp, 'created_at' => Carbon::now()]
        );

        // Redirect the user to the OTP verification page.
        // Store the phone number in the session so the OTP page can use it (and hide it from the user).
        return redirect()->route('phone-otp-verification')
            ->with('t-success', 'OTP sent to your phone.')
            ->with('phone_number', $phoneNumber);
    }

    /**
     * Display the OTP verification view for phone number.
     *
     * @return View
     */
    public function otpVerificationView() {
        // This view should show the form to enter the 4-digit OTP.
        // The phone number is passed as a hidden field from the session.
        return view('auth.layouts.phone-otp-verification');
    }

    /**
     * Verify the OTP and update the user's phone_number_verified_at field.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function verifyOtpForPhone(Request $request) {
        // Validate that we have a phone number (hidden) and 4 OTP digits.
        $request->validate([
            'phone_number' => 'required|string',
            'otp_part'     => 'required|array|size:4',
            'otp_part.*'   => 'required|digits:1',
        ]);

        // Combine the OTP parts into a single 4-digit string.
        $otp         = implode('', $request->input('otp_part'));
        $phoneNumber = $request->input('phone_number');

        // Look up the OTP record by phone number and OTP.
        $record = PasswordReset::where('phone_number', $phoneNumber)
            ->where('otp', $otp)
            ->first();

        if (!$record) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // Find the user by phone number.
        $user = User::where('phone_number', $phoneNumber)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['phone_number' => 'User not found.']);
        }

        // Mark the user's phone as verified.
        $user->update([
            'phone_number_verified_at' => Carbon::now(),
        ]);

        // Delete the OTP record since it has been used.
        $record->delete();

        // Redirect to the verification success page.
        return redirect()->route('verification-success')
            ->with('status', 'Phone number verified successfully.');
    }
}
