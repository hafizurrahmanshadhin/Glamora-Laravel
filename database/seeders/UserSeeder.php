<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => '2025-01-31 23:29:49',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:29:49',
                'updated_at'        => '2025-01-31 23:29:49',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'first_name'        => 'client',
                'last_name'         => 'client',
                'email'             => 'client@client.com',
                'email_verified_at' => '2025-01-31 23:29:49',
                'password'          => Hash::make('12345678'),
                'role'              => 'client',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:29:49',
                'updated_at'        => '2025-01-31 23:29:49',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'first_name'        => 'beauty-expert',
                'last_name'         => 'beauty-expert',
                'email'             => 'beauty-expert@beauty-expert.com',
                'email_verified_at' => '2025-01-31 23:29:49',
                'password'          => Hash::make('12345678'),
                'role'              => 'beauty_expert',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:29:49',
                'updated_at'        => '2025-01-31 23:29:49',
                'deleted_at'        => null,
            ],
            [
                'id'                => 4,
                'first_name'        => 'user',
                'last_name'         => 'user',
                'email'             => 'user@user.com',
                'email_verified_at' => '2025-01-31 23:30:36',
                'password'          => Hash::make('12345678'),
                'role'              => 'client',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:30:36',
                'updated_at'        => '2025-01-31 23:30:36',
                'deleted_at'        => null,
            ],
            [
                'id'                => 5,
                'first_name'        => 'test',
                'last_name'         => 'test',
                'email'             => 'test@test.com',
                'email_verified_at' => '2025-01-31 23:31:23',
                'password'          => Hash::make('12345678'),
                'role'              => 'beauty_expert',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:31:23',
                'updated_at'        => '2025-01-31 23:40:35',
                'deleted_at'        => null,
            ],
            [
                'id'                => 6,
                'first_name'        => 'Hafizur Rahman',
                'last_name'         => 'Shadhin',
                'email'             => 'shadhin666@gmail.com',
                'email_verified_at' => '2025-01-31 23:37:30',
                'password'          => Hash::make('12345678'),
                'role'              => 'beauty_expert',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2025-01-31 23:37:30',
                'updated_at'        => '2025-01-31 23:40:33',
                'deleted_at'        => null,
            ],
        ]);
    }
}
