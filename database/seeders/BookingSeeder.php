<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder {
    public function run(): void {
        DB::table('bookings')->insert([
            [
                'id'               => 1,
                'user_id'          => 2,
                'user_service_id'  => 3,
                'service_type'     => 'salon_services',
                'appointment_date' => '2025-12-31',
                'appointment_time' => '7:00 PM',
                'price'            => 32.40,
                'status'           => 'active',
                'created_at'       => '2025-01-31 23:44:26',
                'updated_at'       => '2025-01-31 23:44:26',
                'deleted_at'       => null,
            ],
            [
                'id'               => 2,
                'user_id'          => 2,
                'user_service_id'  => 9,
                'service_type'     => 'mobile_services',
                'appointment_date' => '2025-12-31',
                'appointment_time' => '9:00 AM',
                'price'            => 240.00,
                'status'           => 'active',
                'created_at'       => '2025-01-31 23:44:54',
                'updated_at'       => '2025-01-31 23:44:54',
                'deleted_at'       => null,
            ],
            [
                'id'               => 3,
                'user_id'          => 2,
                'user_service_id'  => 20,
                'service_type'     => 'mobile_services',
                'appointment_date' => '2027-12-31',
                'appointment_time' => '7:00 PM',
                'price'            => 442.80,
                'status'           => 'active',
                'created_at'       => '2025-01-31 23:45:34',
                'updated_at'       => '2025-01-31 23:45:34',
                'deleted_at'       => null,
            ],
            [
                'id'               => 4,
                'user_id'          => 2,
                'user_service_id'  => 1,
                'service_type'     => 'salon_services',
                'appointment_date' => '2025-02-27',
                'appointment_time' => '9:00 AM',
                'price'            => 10.80,
                'status'           => 'active',
                'created_at'       => '2025-01-31 23:48:00',
                'updated_at'       => '2025-01-31 23:48:00',
                'deleted_at'       => null,
            ],
            [
                'id'               => 5,
                'user_id'          => 4,
                'user_service_id'  => 6,
                'service_type'     => 'salon_services',
                'appointment_date' => '2025-02-28',
                'appointment_time' => '11:00 PM',
                'price'            => 540.00,
                'status'           => 'active',
                'created_at'       => '2025-01-31 23:48:59',
                'updated_at'       => '2025-01-31 23:48:59',
                'deleted_at'       => null,
            ],
        ]);
    }
}
