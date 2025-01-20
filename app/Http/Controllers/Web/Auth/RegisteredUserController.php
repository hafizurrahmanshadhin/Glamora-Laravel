<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
    public function create(): View {
        return view('auth.layouts.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'role'       => ['required', 'in:client,beauty_expert'],
        ]);

        $user = User::create([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
            'role'              => $request->role,
            'status'            => $request->role === 'beauty_expert' ? 'inactive' : 'active',
        ]);

        event(new Registered($user));

        if ($user->role === 'beauty_expert' && $user->status === 'inactive') {
            Auth::login($user);
            return redirect()->route('business-information')->with('status', 'Please complete your business information.');
        }

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'client') {
            return redirect()->route('client-dashboard');
        } else {
            return redirect()->route('questionnaires');
        }
    }
}
