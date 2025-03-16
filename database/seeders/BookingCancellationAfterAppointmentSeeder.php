<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingCancellationAfterAppointmentSeeder extends Seeder {
    public function run(): void {
        DB::table('booking_cancellation_after_appointments')->insert([
            [
                'id'           => 1,
                'booking_id'   => 2,
                'canceled_by'  => 5,
                'requested_by' => 2,
                'status'       => 'active',
                'created_at'   => '2025-03-16 03:13:41',
                'updated_at'   => '2025-03-16 03:13:41',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'booking_id'   => 5,
                'canceled_by'  => 3,
                'requested_by' => 4,
                'status'       => 'active',
                'created_at'   => '2025-03-16 03:14:24',
                'updated_at'   => '2025-03-16 03:14:24',
                'deleted_at'   => null,
            ],
        ]);
    }
}
