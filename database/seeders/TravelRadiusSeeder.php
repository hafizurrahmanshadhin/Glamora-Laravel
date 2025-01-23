<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'created_at'        => Carbon::parse('2025-01-23 00:40:31'),
                'updated_at'        => Carbon::parse('2025-01-23 00:40:31'),
                'deleted_at'        => null,
            ],
        ]);
    }
}
