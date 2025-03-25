<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Models\CMSImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the login view.
     */
    public function create(): View | JsonResponse {
        try {
            // Fetch dynamic auth page banners from the CMS images table
            $authBanner = CMSImage::where('page', 'auth')
                ->where('status', 'active')
                ->first();

            return view('auth.layouts.login', compact('authBanner'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse | JsonResponse {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $user = Auth::user();

            // Check if the user is still banned
            if ($user->banned_until && now()->lt($user->banned_until)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Show a ban error similar to failed login
                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'Your account is banned until ' . $user->banned_until->format('Y-m-d H:i') . '.',
                    ]);
            }

            if ($user->role === 'beauty_expert' && $user->status === 'inactive') {
                Auth::guard('web')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('profile-submitted')->with('status', 'Your profile is under review. Please wait for approval.');
            }

            // If a redirect_to parameter exists and user is a client, redirect back to the intended page
            if ($user->role === 'client' && $request->filled('redirect_to')) {
                return redirect()->to($request->input('redirect_to'));
            }

            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'client') {
                return redirect()->route('client-dashboard');
            } else {
                return redirect()->route('beauty-expert-dashboard');
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse | JsonResponse {
        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
