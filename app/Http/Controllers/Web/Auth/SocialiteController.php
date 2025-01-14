<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller {
    /**
     * Redirects the user to Google's OAuth page for authentication.
     *
     * @return RedirectResponse
     */
    public function GoogleRedirect(): RedirectResponse {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles the callback after Google has authenticated the user.
     *
     * @return RedirectResponse
     */
    public function GoogleCallback(): RedirectResponse {
        $user = Socialite::driver('google')->user();
        // dd($user);

        $findUser = User::where('google_id', $user->id)->first();

        if ($findUser) {
            auth()->login($findUser);
        } else {
            $newUser = User::create([
                'firstName'            => $user->name,
                'email'                => $user->email,
                'password'             => bcrypt(Str::random(20)),
                'google_id'            => $user->id,
                'avatar'               => $user->avatar,
                'terms_and_conditions' => true,
            ]);

            auth()->login($newUser);
        }
        return redirect()->route('company-info');
    }
}
