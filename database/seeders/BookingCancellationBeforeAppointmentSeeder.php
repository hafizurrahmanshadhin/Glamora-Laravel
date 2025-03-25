<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingCancellationBeforeAppointmentSeeder extends Seeder {
    public function run(): void {
        DB::table('booking_cancellation_before_appointments')->insert([
            [
                'id'           => 1,
                'booking_id'   => 6,
                'canceled_by'  => 3,
                'requested_by' => 2,
                'status'       => 'active',
                'created_at'   => Carbon::parse('2025-03-14 20:58:40'),
                'updated_at'   => Carbon::parse('2025-03-14 20:58:40'),
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'booking_id'   => 7,
                'canceled_by'  => 3,
                'requested_by' => 2,
                'status'       => 'active',
                'created_at'   => Carbon::parse('2025-03-14 21:00:53'),
                'updated_at'   => Carbon::parse('2025-03-14 21:00:53'),
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'booking_id'   => 8,
                'canceled_by'  => 3,
                'requested_by' => 4,
                'status'       => 'active',
                'created_at'   => Carbon::parse('2025-03-14 21:03:35'),
                'updated_at'   => Carbon::parse('2025-03-14 21:03:35'),
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'booking_id'   => 9,
                'canceled_by'  => 3,
                'requested_by' => 4,
                'status'       => 'active',
                'created_at'   => Carbon::parse('2025-03-14 21:04:15'),
                'updated_at'   => Carbon::parse('2025-03-14 21:04:15'),
                'deleted_at'   => null,
            ],
        ]);
    }
}
