<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMSImage;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller {
    /**
     * Display the registration view.
     */
    public function create(): View | JsonResponse {
        try {
            // Fetch data using static methods from CMSImage model
            $authBanner = CMSImage::authBanner();

            return view('auth.layouts.register', compact('authBanner'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse | JsonResponse {
        // First, format the phone number to check for uniqueness
        $formattedPhoneNumber = $this->formatPhoneNumber($request->phone_number);

        $request->validate([
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => [
                'required',
                'string',
                'max:15',
                function ($attribute, $value, $fail) use ($formattedPhoneNumber) {
                    // Check if phone number format is valid
                    if (!$this->isValidPhoneNumber($value)) {
                        $fail('Please enter a valid phone number. Accepted formats: Bangladesh (+8801xxxxxxxx or 01xxxxxxxx) or Australia (+614xxxxxxxx, 04xxxxxxxx, +61[2-8]xxxxxxxx, 0[2-8]xxxxxxxx)');
                        return;
                    }

                    // Check if formatted phone number already exists
                    if (User::where('phone_number', $formattedPhoneNumber)->exists()) {
                        $fail('This phone number is already registered.');
                    }
                },
            ],
            'address'      => ['required', 'string'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'role'         => ['required', 'in:client,beauty_expert'],
        ]);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $formattedPhoneNumber,
            'address'      => $request->address,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'status'       => $request->role === 'beauty_expert' ? 'inactive' : 'active',
        ]);

        event(new Registered($user));

        if ($user->role === 'beauty_expert' && $user->status === 'inactive') {
            Auth::login($user);
            return redirect()->route('questionnaires')->with('status', 'Please complete your business information.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'client') {
            return redirect()->route('phone-number-verification');
        } else {
            return redirect()->route('questionnaires');
        }
    }

    /**
     * Validate if the phone number is from Bangladesh or Australia
     *
     * @param string $phoneNumber
     * @return bool
     */
    private function isValidPhoneNumber(string $phoneNumber): bool {
        // Remove all non-digit characters except + at the beginning
        $cleanNumber = preg_replace('/[^\d+]/', '', $phoneNumber);

        // Bangladesh phone number validation
        // Format: +8801xxxxxxxxx or 01xxxxxxxxx (11 digits total after country code)
        // Valid mobile prefixes: 013, 014, 015, 016, 017, 018, 019

        // Bangladesh with country code (+880)
        if (preg_match('/^\+8801[3-9]\d{8}$/', $cleanNumber)) {
            return true;
        }

        // Bangladesh without country code (01xxxxxxxxx)
        if (preg_match('/^01[3-9]\d{8}$/', $cleanNumber)) {
            return true;
        }

        // Australian phone number validation

        // Australian mobile with country code (+614xxxxxxxx)
        if (preg_match('/^\+614\d{8}$/', $cleanNumber)) {
            return true;
        }

        // Australian mobile without country code (04xxxxxxxx)
        if (preg_match('/^04\d{8}$/', $cleanNumber)) {
            return true;
        }

        // Australian landline with country code (+61[2-8]xxxxxxxx)
        if (preg_match('/^\+61[2-8]\d{8}$/', $cleanNumber)) {
            return true;
        }

        // Australian landline without country code (0[2-8]xxxxxxxx)
        if (preg_match('/^0[2-8]\d{8}$/', $cleanNumber)) {
            return true;
        }

        return false;
    }

    /**
     * Format phone number to international format
     *
     * @param string $phoneNumber
     * @return string
     */
    private function formatPhoneNumber(string $phoneNumber): string {
        // Remove all non-digit characters except + at the beginning
        $cleanNumber = preg_replace('/[^\d+]/', '', $phoneNumber);

        // Bangladesh number formatting
        if (preg_match('/^01[3-9]\d{8}$/', $cleanNumber)) {
            return '+880' . substr($cleanNumber, 1);
        }

        // Australian mobile number formatting (04xxxxxxxx -> +614xxxxxxxx)
        if (preg_match('/^04\d{8}$/', $cleanNumber)) {
            return '+61' . substr($cleanNumber, 1);
        }

        // Australian landline number formatting (0[2-8]xxxxxxxx -> +61[2-8]xxxxxxxx)
        if (preg_match('/^0[2-8]\d{8}$/', $cleanNumber)) {
            return '+61' . substr($cleanNumber, 1);
        }

        // If already in correct international format, return as is
        return $cleanNumber;
    }
}
