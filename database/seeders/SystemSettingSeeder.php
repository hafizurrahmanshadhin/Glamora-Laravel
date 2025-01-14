<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder {
    public function run(): void {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'Admin_Dashboard_Dosix',
                'system_name'    => 'Admin_Dashboard_Dosix',
                'email'          => 'info@support.com',
                'phone_number'   => '01915696677',
                'address'        => 'Mohammadpur, Dhaka, Bangladesh',
                'copyright_text' => '©Admin_Dashboard_Dosix',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2024-12-08 05:08:00',
                'updated_at'     => '2024-12-08 05:08:00',
            ],
        ]);
    }
}
