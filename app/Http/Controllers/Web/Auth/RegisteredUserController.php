<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\CMSImage;
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
        $authBanner = CMSImage::where('page', 'auth')
            ->where('status', 'active')
            ->first();

        return view('auth.layouts.register', compact('authBanner'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'address'      => ['required', 'string'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'role'         => ['required', 'in:client,beauty_expert'],
        ]);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
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
}
