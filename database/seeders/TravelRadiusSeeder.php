<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelRadiusSeeder extends Seeder {
    public function run(): void {
        DB::table('travel_radius')->insert([
            [
                'id'                => 1,
                'user_id'           => 3,
                'free_radius'       => 10,
                'travel_radius'     => 25,
                'travel_charge'     => 25.00,
                'max_radius'        => 100,
                'max_charge'        => 100.00,
                'min_booking_value' => 50.00,
                'status'            => 'active',
                'created_at'        => '2025-01-12 18:40:31',
                'updated_at'        => '2025-01-13 18:40:31',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'user_id'           => 5,
                'free_radius'       => 5,
                'travel_radius'     => 10,
                'travel_charge'     => 10.00,
                'max_radius'        => 50,
                'max_charge'        => 50.00,
                'min_booking_value' => 25.00,
                'status'            => 'active',
                'created_at'        => '2025-01-24 23:34:10',
                'updated_at'        => '2025-01-25 23:34:10',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'user_id'           => 6,
                'free_radius'       => 10,
                'travel_radius'     => 25,
                'travel_charge'     => 25.00,
                'max_radius'        => 100,
                'max_charge'        => 100.00,
                'min_booking_value' => 50.00,
                'status'            => 'active',
                'created_at'        => '2025-01-08 23:38:39',
                'updated_at'        => '2025-01-09 23:38:39',
                'deleted_at'        => null,
            ],
            [
                'id'                => 4,
                'user_id'           => 7,
                'free_radius'       => 89,
                'travel_radius'     => 63,
                'travel_charge'     => 53.00,
                'max_radius'        => 91,
                'max_charge'        => 16.00,
                'min_booking_value' => 0.00,
                'status'            => 'active',
                'created_at'        => '2025-02-04 04:43:12',
                'updated_at'        => '2025-02-04 04:43:12',
                'deleted_at'        => null,
            ],
        ]);
    }
}
