<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder {
    public function run(): void {
        DB::table('orders')->insert([
            [
                'id'           => 1,
                'user_id'      => 2,
                'booking_id'   => 1,
                'total_amount' => 32.40,
                'status'       => 'paid',
                'created_at'   => '2025-01-31 17:47:28',
                'updated_at'   => '2025-01-31 17:47:28',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'user_id'      => 2,
                'booking_id'   => 2,
                'total_amount' => 240.00,
                'status'       => 'paid',
                'created_at'   => '2025-01-31 17:49:49',
                'updated_at'   => '2025-01-31 17:49:49',
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'user_id'      => 4,
                'booking_id'   => 5,
                'total_amount' => 540.00,
                'status'       => 'paid',
                'created_at'   => '2025-02-01 04:01:51',
                'updated_at'   => '2025-02-01 04:01:51',
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'user_id'      => 2,
                'booking_id'   => 2,
                'total_amount' => 240.00,
                'status'       => 'paid',
                'created_at'   => '2025-02-01 04:07:10',
                'updated_at'   => '2025-02-01 04:07:10',
                'deleted_at'   => null,
            ],
        ]);
    }
}
