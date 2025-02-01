<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder {
    public function run(): void {
        DB::table('reports')->insert([
            [
                'id'         => 1,
                'user_id'    => 2,
                'booking_id' => 3,
                'message'    => 'In Complete Service, Mark as Report...',
                'status'     => 'active',
                'created_at' => '2025-01-31 23:51:55',
                'updated_at' => '2025-01-31 23:51:55',
                'deleted_at' => null,
            ],
        ]);
    }
}
