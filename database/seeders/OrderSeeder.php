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
                'created_at'   => '2025-01-31 23:47:28',
                'updated_at'   => '2025-01-31 23:47:28',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'user_id'      => 2,
                'booking_id'   => 2,
                'total_amount' => 240.00,
                'status'       => 'paid',
                'created_at'   => '2025-01-31 23:49:49',
                'updated_at'   => '2025-01-31 23:49:49',
                'deleted_at'   => null,
            ],
        ]);
    }
}
