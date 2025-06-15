<?php

namespace App\Http\Requests\Web\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void {
        $this->ensureIsNotRateLimited();

        // First, check if user exists (including banned users)
        $user = User::withBanned()->where('email', $this->email)->first();
        if (!$user || !Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Check if user is banned
        if ($user->banned_until && now()->lt($user->banned_until)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Your account is banned until ' . $user->banned_until->format('Y-m-d H:i') . '.',
            ]);
        }

        // Try normal authentication (this will work now since user is not banned)
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Check if user has email or phone verified
        $user = Auth::user();
        if (!$user->email_verified_at || !$user->phone_number_verified_at) {
            Auth::logout();

            $missingVerifications = [];
            if (!$user->email_verified_at) {
                $missingVerifications[] = 'email';
            }
            if (!$user->phone_number_verified_at) {
                $missingVerifications[] = 'phone number';
            }

            $message = 'Please verify your ' . implode(' and ', $missingVerifications) . ' to log in.';

            throw ValidationException::withMessages([
                'email' => $message,
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
