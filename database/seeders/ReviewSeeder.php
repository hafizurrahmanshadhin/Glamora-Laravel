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
                'review'     => 'I found the perfect makeup artist for my wedding through this platform! The entire process was smooth, and the artist was professional and talented. I couldn\'t have asked for a better experience!',
                'rating'     => 5,
                'status'     => 'active',
                'created_at' => '2025-01-31 17:52:17',
                'updated_at' => '2025-01-31 17:52:17',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'user_id'    => 4,
                'booking_id' => 5,
                'review'     => 'I found the perfect makeup artist for my wedding through this platform! The entire process was smooth, and the artist was professional and talented. I couldn\'t have asked for a better experience!',
                'rating'     => 4,
                'status'     => 'active',
                'created_at' => '2025-02-01 04:02:32',
                'updated_at' => '2025-02-01 04:02:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'user_id'    => 5,
                'booking_id' => 3,
                'review'     => 'I found the perfect makeup artist for my wedding through this platform! The entire process was smooth, and the artist was professional and talented. I couldn\'t have asked for a better experience!',
                'rating'     => 3,
                'status'     => 'active',
                'created_at' => '2025-02-01 04:05:55',
                'updated_at' => '2025-02-01 10:06:07',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'user_id'    => 6,
                'booking_id' => 3,
                'review'     => 'I found the perfect makeup artist for my wedding through this platform! The entire process was smooth, and the artist was professional and talented. I couldn\'t have asked for a better experience!',
                'rating'     => 5,
                'status'     => 'active',
                'created_at' => '2025-02-01 04:06:26',
                'updated_at' => '2025-02-01 10:06:37',
                'deleted_at' => null,
            ],
        ]);
    }
}
