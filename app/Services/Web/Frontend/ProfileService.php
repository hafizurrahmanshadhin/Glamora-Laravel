<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class ProfileService {
    /**
     * Update user profile information.
     *
     * @param User $user
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function updateProfile(User $user, array $data): void {
        try {
            $user->first_name   = $data['first_name'] ?? $user->first_name;
            $user->last_name    = $data['last_name'] ?? $user->last_name;
            $user->phone_number = $data['phone_number'] ?? $user->phone_number;
            $user->address      = $data['address'] ?? $user->address;

            // Check if the user has requested to remove the avatar
            if (request()->input('remove_avatar') == 1 && !request()->hasFile('avatar')) {
                if ($user->avatar) {
                    Helper::fileDelete(public_path($user->avatar));
                }
                $user->avatar = null;
            } elseif (request()->hasFile('avatar')) {
                // Delete the old avatar if exists
                if ($user->avatar) {
                    Helper::fileDelete(public_path($user->avatar));
                }
                $user->avatar = Helper::fileUpload($data['avatar'], 'avatars', $data['first_name'] ?? '');
            }

            $user->save();
        } catch (Exception $e) {
            throw new Exception('Profile update failed: ' . $e->getMessage());
        }
    }

    /**
     * Update user password.
     *
     * @param User $user
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function updatePassword(User $user, array $data): void {
        try {
            if (!Hash::check($data['current_password'], $user->password)) {
                throw new Exception('Current password is incorrect.');
            }
            $user->password = Hash::make($data['new_password']);
            $user->save();
        } catch (Exception $e) {
            throw new Exception('Password update failed: ' . $e->getMessage());
        }
    }
}
