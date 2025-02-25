<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder {
    public function run(): void {
        DB::table('services')->insert([
            [
                'id'            => 1,
                'services_name' => 'Non-Bridal Makeup Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:03:21',
                'updated_at'    => '2025-01-19 00:03:21',
                'deleted_at'    => null,
            ],
            [
                'id'            => 2,
                'services_name' => 'Hair Up Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:05:29',
                'updated_at'    => '2025-01-19 00:05:29',
                'deleted_at'    => null,
            ],
            [
                'id'            => 3,
                'services_name' => 'Hair Down Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:05:44',
                'updated_at'    => '2025-01-19 00:05:44',
                'deleted_at'    => null,
            ],
            [
                'id'            => 4,
                'services_name' => 'Half Up, Half Down Only',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:05:58',
                'updated_at'    => '2025-01-19 00:05:58',
                'deleted_at'    => null,
            ],
            [
                'id'            => 5,
                'services_name' => 'Makeup with Hair Up',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:06:14',
                'updated_at'    => '2025-01-19 00:06:14',
                'deleted_at'    => null,
            ],
            [
                'id'            => 6,
                'services_name' => 'Makeup with Hair Down',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:06:24',
                'updated_at'    => '2025-01-19 00:06:24',
                'deleted_at'    => null,
            ],
            [
                'id'            => 7,
                'services_name' => 'Makeup with Half Up, Down',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:06:37',
                'updated_at'    => '2025-01-19 00:06:37',
                'deleted_at'    => null,
            ],
            [
                'id'            => 8,
                'services_name' => 'Bridal make up or hair',
                'platform_fee'  => 20,
                'status'        => 'active',
                'created_at'    => '2025-01-19 00:06:37',
                'updated_at'    => '2025-01-19 00:06:37',
                'deleted_at'    => null,
            ],
        ]);
    }
}
