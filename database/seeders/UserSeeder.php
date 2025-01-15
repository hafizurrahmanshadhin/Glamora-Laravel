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
                'id'                => 1,
                'first_name'        => 'admin',
                'last_name'         => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'status'            => 'active',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 2,
                'first_name'        => 'client',
                'last_name'         => 'client',
                'email'             => 'client@client.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('12345678'),
                'role'              => 'client',
                'status'            => 'active',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 3,
                'first_name'        => 'beauty-expert',
                'last_name'         => 'beauty-expert',
                'email'             => 'beauty-expert@beauty-expert.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('12345678'),
                'role'              => 'beauty_expert',
                'status'            => 'active',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
