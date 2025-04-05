<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder {
    public function run(): void {
        DB::table('services')->insert([
            [
                'id'            => 1,
                'services_name' => 'Natural or Full Glam Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:03:21',
                'updated_at'    => '2025-04-04 22:03:30',
            ],
            [
                'id'            => 2,
                'services_name' => 'Hair Up Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:05:29',
                'updated_at'    => '2025-01-18 18:05:29',
            ],
            [
                'id'            => 3,
                'services_name' => 'Hair Down Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:05:44',
                'updated_at'    => '2025-01-18 18:05:44',
            ],
            [
                'id'            => 4,
                'services_name' => 'Hair half up, half down only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:05:58',
                'updated_at'    => '2025-04-04 22:04:15',
            ],
            [
                'id'            => 5,
                'services_name' => 'Glam with Hair Up',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:06:14',
                'updated_at'    => '2025-04-04 22:04:59',
            ],
            [
                'id'            => 6,
                'services_name' => 'Glam with Hair Down',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:06:24',
                'updated_at'    => '2025-04-04 22:05:26',
            ],
            [
                'id'            => 7,
                'services_name' => 'Glam with hair half up, half down',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:06:37',
                'updated_at'    => '2025-04-04 22:05:56',
            ],
            [
                'id'            => 8,
                'services_name' => 'Natural Glam with simple hairstyling',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-18 18:06:37',
                'updated_at'    => '2025-04-04 22:07:54',
            ],
        ]);
    }
}
