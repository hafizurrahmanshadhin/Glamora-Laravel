<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder {
    public function run(): void {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'Glamora',
                'system_name'    => 'Glamora',
                'email'          => 'support@Glamora.com',
                'phone_number'   => '0123456789',
                'address'        => '123 Main St, Suite 101, City, State, ZIP',
                'copyright_text' => '© 2024 Glamora. All rights reserved.',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2024-12-08 05:08:00',
                'updated_at'     => '2024-12-08 05:08:00',
            ],
        ]);
    }
}
