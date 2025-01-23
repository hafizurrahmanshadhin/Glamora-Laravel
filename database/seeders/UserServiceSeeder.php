<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserServiceSeeder extends Seeder {
    public function run(): void {
        DB::table('user_services')->insert([
            [
                'id'            => 1,
                'user_id'       => 3,
                'service_id'    => 1,
                'selected'      => 1,
                'offered_price' => 10.00,
                'total_price'   => 12.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:00'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 2,
                'user_id'       => 3,
                'service_id'    => 2,
                'selected'      => 1,
                'offered_price' => 20.00,
                'total_price'   => 24.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:01'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 3,
                'user_id'       => 3,
                'service_id'    => 3,
                'selected'      => 1,
                'offered_price' => 30.00,
                'total_price'   => 36.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:02'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 4,
                'user_id'       => 3,
                'service_id'    => 4,
                'selected'      => 1,
                'offered_price' => 40.00,
                'total_price'   => 48.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:03'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 5,
                'user_id'       => 3,
                'service_id'    => 5,
                'selected'      => 1,
                'offered_price' => 50.00,
                'total_price'   => 60.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:04'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 6,
                'user_id'       => 3,
                'service_id'    => 6,
                'selected'      => 1,
                'offered_price' => 60.00,
                'total_price'   => 72.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:05'),
                'deleted_at'    => null,
            ],
            [
                'id'            => 7,
                'user_id'       => 3,
                'service_id'    => 7,
                'selected'      => 1,
                'offered_price' => 70.00,
                'total_price'   => 84.00,
                'image'         => 'frontend/service-image-2.jpg',
                'status'        => 'active',
                'created_at'    => Carbon::parse('2025-01-23 00:41:42'),
                'updated_at'    => Carbon::parse('2025-01-23 00:43:06'),
                'deleted_at'    => null,
            ],
        ]);
    }
}
