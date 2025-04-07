<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Frontend\Profile\UpdatePasswordRequest;
use App\Http\Requests\Web\Frontend\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Services\Web\Frontend\ProfileService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    /**
     * Update user profile information.
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse | RedirectResponse {
        try {
            $user = Auth::user();
            if (!$user instanceof User) {
                return back()->with('t-error', 'No authenticated user found.');
            }
            $this->profileService->updateProfile($user, $request->validated());

            return redirect()->back()->with('t-success', 'Profile updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update user password.
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse | RedirectResponse {
        try {
            $user = Auth::user();
            if (!$user instanceof User) {
                return back()->with('t-error', 'No authenticated user found.');
            }
            $this->profileService->updatePassword($user, $request->validated());

            return redirect()->back()->with('t-success', 'Password updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['current_password' => $e->getMessage()])
                ->withInput()
                ->with('t-error', $e->getMessage());
        }
    }
}
