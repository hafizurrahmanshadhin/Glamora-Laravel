<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder {
    public function run(): void {
        DB::table('reviews')->insert([
            [
                'id'         => 1,
                'user_id'    => 2,
                'booking_id' => 3,
                'review'     => 'Well Done!,,, Nice Work...',
                'rating'     => 5,
                'status'     => 'active',
                'created_at' => '2025-01-31 23:52:17',
                'updated_at' => '2025-01-31 23:52:17',
                'deleted_at' => null,
            ],
        ]);
    }
}
