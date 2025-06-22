<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Twilio\Rest\Client;

class PhoneNumberVerificationController extends Controller {
    /**
     * Display the phone number verification view.
     *
     * @return JsonResponse|View
     */
    public function index(): JsonResponse | View {
        try {
            // Fetch data using static methods from CMS model
            $authBanner = CMS::authBanner();

            return view('auth.layouts.verification-using-phone-number', compact('authBanner'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle sending the OTP to the user's phone number via SMS.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function sendOtpToPhone(Request $request): RedirectResponse {
        // Validate the phone number (adjust the regex as needed)
        $request->validate([
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,3}\)?[\s-]?)?[\d\s-]{7,15}$/',
            ],
        ]);

        $phoneNumber = $request->input('phone_number');

        // Ensure phone number is in international format
        if (!str_starts_with($phoneNumber, '+')) {
            // For Bangladesh numbers, add +880 prefix if not present
            if (preg_match('/^01[3-9]\d{8}$/', $phoneNumber)) {
                $phoneNumber = '+880' . substr($phoneNumber, 1);
            } else {
                return redirect()->back()
                    ->withErrors(['phone_number' => 'Please enter a valid phone number with country code.']);
            }
        }

        // Generate a 4-digit OTP (with leading zeros if needed)
        $otp = sprintf("%04d", rand(0, 9999));

        // Send the OTP via SMS using Twilio
        $sid   = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from  = config('services.twilio.from');

        if (!$sid || !$token || !$from) {
            Log::error('Twilio configuration missing', [
                'sid_present'   => !empty($sid),
                'token_present' => !empty($token),
                'from_present'  => !empty($from),
            ]);
            return redirect()->back()
                ->withErrors(['phone_number' => 'SMS service is not properly configured.']);
        }

        try {
            $client = new Client($sid, $token);

            Log::info('Attempting to send SMS', [
                'to'   => $phoneNumber,
                'from' => $from,
                'sid'  => $sid,
            ]);

            $message = $client->messages->create($phoneNumber, [
                'body' => "Your OTP is: $otp",
                'from' => $from,
            ]);

            Log::info('SMS sent successfully', ['message_sid' => $message->sid]);

        } catch (Exception $e) {
            Log::error("Twilio error: " . $e->getMessage(), [
                'phone_number' => $phoneNumber,
                'error_code'   => $e->getCode(),
            ]);
            return redirect()->back()
                ->withErrors(['phone_number' => 'Failed to send SMS. Please check your phone number and try again.']);
        }

        // Save or update the OTP record in the password_resets table
        PasswordReset::updateOrCreate(
            ['phone_number' => $phoneNumber],
            ['otp' => $otp, 'created_at' => Carbon::now()]
        );

        // Redirect the user to the OTP verification page.
        return redirect()->route('phone-otp-verification')
            ->with('t-success', 'OTP sent to your phone.')
            ->with('phone_number', $phoneNumber);
    }

    /**
     * Display the OTP verification view for phone number.
     *
     * @return JsonResponse|View
     */
    public function otpVerificationView(): JsonResponse | View {
        try {
            return view('auth.layouts.phone-otp-verification');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Verify the OTP and update the user's phone_number_verified_at field.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function verifyOtpForPhone(Request $request): JsonResponse | RedirectResponse {
        try {
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
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
