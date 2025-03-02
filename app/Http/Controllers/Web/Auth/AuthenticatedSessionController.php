<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Models\CMSImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the login view.
     */
    public function create(): View {
        // Fetch dynamic auth page banners from the CMS images table
        $authBanner = CMSImage::where('page', 'auth')
            ->where('status', 'active')
            ->first();

        return view('auth.layouts.login', compact('authBanner'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'beauty_expert' && $user->status === 'inactive') {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('profile-submitted')->with('status', 'Your profile is under review. Please wait for approval.');
        }

        // If a redirect_to parameter exists and user is a client, redirect back to the intended page
        if ($user->role === 'client' && $request->filled('redirect_to')) {
            return redirect($request->input('redirect_to'));
        }

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'client') {
            return redirect()->route('client-dashboard');
        } else {
            return redirect()->route('beauty-expert-dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
