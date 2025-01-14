<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'id'                   => 1,
                'first_name'           => 'admin',
                'last_name'            => 'admin',
                'email'                => 'admin@admin.com',
                'email_verified_at'    => Carbon::now(),
                'phone_number'         => '0123456789',
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'admin',
                'status'               => 'active',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 2,
                'first_name'           => 'user',
                'last_name'            => 'user',
                'email'                => 'user@user.com',
                'email_verified_at'    => Carbon::now(),
                'phone_number'         => '1234567890',
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'user',
                'status'               => 'active',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 3,
                'first_name'           => 'Hafizur Rahman',
                'last_name'            => 'Shadhin',
                'email'                => 'shadhin666@gmail.com',
                'email_verified_at'    => Carbon::now(),
                'phone_number'         => '+8801719922812',
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'admin',
                'status'               => 'active',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
