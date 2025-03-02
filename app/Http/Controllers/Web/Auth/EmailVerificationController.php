<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\CMSImage;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EmailVerificationController extends Controller {
    /**
     * Display the email verification view.
     *
     * @return View
     */
    public function index(): View {
        $authBanner = CMSImage::where('page', 'auth')
            ->where('status', 'active')
            ->first();

        return view('auth.layouts.verification-using-email', compact('authBanner'));
    }

    /**
     * Handle sending the OTP to the user’s email.
     */
    public function sendOtpToEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a 4-digit OTP (padded with zeros if needed)
        $otp = sprintf("%04d", rand(0, 9999));

        // Create or update the OTP record in the password_resets table
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'otp'        => $otp,
                'created_at' => Carbon::now(),
            ]
        );

        // Send the OTP via email
        Mail::raw("Your verification code is: {$otp}", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Email Verification OTP');
        });

        // Redirect user to the OTP verification page with the email in the session
        return redirect()->route('otp-verification')
            ->with('t-success', 'OTP sent to your email.')
            ->with('email', $request->email);
    }

    /**
     * Display the email verification view.
     *
     * @return View
     *
     */
    public function otpVerificationView(): View {
        $authBanner = CMSImage::where('page', 'auth')
            ->where('status', 'active')
            ->first();

        return view('auth.layouts.otp-verification', compact('authBanner'));
    }

    /**
     * Verify the OTP and update the user’s email_verified_at.
     */
    public function verifyOTP(Request $request) {
        // Validate the request.
        // We expect an email (hidden field) and an array of 4 OTP digits.
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email|exists:users,email',
            'otp_part'   => 'required|array|size:4',
            'otp_part.*' => 'required|digits:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Combine the OTP parts into a single string
        $otp   = implode('', $request->otp_part);
        $email = $request->email;

        // Check the OTP in the password_resets table
        $record = PasswordReset::where('email', $email)
            ->where('otp', $otp)
            ->first();

        if (!$record) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // Mark user as verified by updating email_verified_at
        $user                    = User::where('email', $email)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();

        // Remove the OTP record since it has been used
        $record->delete();

        // Redirect to the verification success page
        return redirect()->route('verification-success')
            ->with('status', 'Email verified successfully.');
    }
}
