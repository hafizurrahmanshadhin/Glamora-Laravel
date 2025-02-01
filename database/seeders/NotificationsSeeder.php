<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsSeeder extends Seeder {
    public function run(): void {
        DB::table('notifications')->insert([
            [
                'id'              => '044c4fb2-b0da-4b25-a25f-68924e3a8e40',
                'type'            => 'App\\Notifications\\BookingNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 3,
                'data'            => '{"message":"New booking created by a client","booking_id":4,"user_service_id":1,"service_type":"salon_services","appointment_date":"2025-02-27T00:00:00.000000Z","appointment_time":"9:00 AM"}',
                'read_at'         => '2025-01-31 18:33:18',
                'created_at'      => '2025-01-31 17:48:00',
                'updated_at'      => '2025-01-31 18:33:18',
            ],
            [
                'id'              => '0752fc10-9248-4119-9ea8-99e3cd973e0e',
                'type'            => 'App\\Notifications\\BookingNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 5,
                'data'            => '{"message":"New booking created by a client","booking_id":5,"user_service_id":12,"service_type":"salon_services","appointment_date":"2025-02-28T00:00:00.000000Z","appointment_time":"11:00 PM"}',
                'read_at'         => '2025-02-01 04:00:38',
                'created_at'      => '2025-01-31 17:48:59',
                'updated_at'      => '2025-02-01 04:00:38',
            ],
            [
                'id'              => '104383fd-9f91-45cd-ac6e-672b1afb3af3',
                'type'            => 'App\\Notifications\\BookingNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 3,
                'data'            => '{"message":"New booking created by a client","booking_id":1,"user_service_id":3,"service_type":"salon_services","appointment_date":"2025-12-31T00:00:00.000000Z","appointment_time":"7:00 PM"}',
                'read_at'         => '2025-01-31 18:33:22',
                'created_at'      => '2025-01-31 17:44:26',
                'updated_at'      => '2025-01-31 18:33:22',
            ],
            [
                'id'              => '4d35b934-4928-4d25-912d-cb64ffb61537',
                'type'            => 'App\\Notifications\\BookingNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 5,
                'data'            => '{"message":"New booking created by a client","booking_id":2,"user_service_id":9,"service_type":"mobile_services","appointment_date":"2025-12-31T00:00:00.000000Z","appointment_time":"9:00 AM"}',
                'read_at'         => '2025-02-01 04:00:48',
                'created_at'      => '2025-01-31 17:44:54',
                'updated_at'      => '2025-02-01 04:00:48',
            ],
            [
                'id'              => '8d38335a-ef58-4a59-bd98-111f67db0c16',
                'type'            => 'App\\Notifications\\BookingStatusNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 4,
                'data'            => '{"message":"I\u2019m Available with Date: 2025-02-28 00:00:00, Time: 11:00 PM, Price: 540.00","booking_id":5}',
                'read_at'         => '2025-02-01 04:01:20',
                'created_at'      => '2025-02-01 04:00:44',
                'updated_at'      => '2025-02-01 04:01:20',
            ],
            [
                'id'              => '947cac00-3bad-43df-935c-37923d884122',
                'type'            => 'App\\Notifications\\BookingStatusNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 2,
                'data'            => '{"message":"I\u2019m Available with Date: 2025-12-31 00:00:00, Time: 9:00 AM, Price: 240.00","booking_id":2}',
                'read_at'         => '2025-02-01 04:06:48',
                'created_at'      => '2025-02-01 04:00:52',
                'updated_at'      => '2025-02-01 04:06:48',
            ],
            [
                'id'              => '94f80fb3-63b7-4b53-9ac3-124ec640079c',
                'type'            => 'App\\Notifications\\BookingStatusNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 2,
                'data'            => '{"message":"I\u2019m Available with Date: 2025-12-31 00:00:00, Time: 7:00 PM, Price: 32.40","booking_id":1}',
                'read_at'         => '2025-01-31 18:32:43',
                'created_at'      => '2025-01-31 17:46:30',
                'updated_at'      => '2025-01-31 18:32:43',
            ],
            [
                'id'              => 'bdd592ba-8e79-4a35-804c-bd4108bcf7c4',
                'type'            => 'App\\Notifications\\BookingStatusNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 2,
                'data'            => '{"message":"I\u2019m Available with Date: 2025-12-31 00:00:00, Time: 9:00 AM, Price: 240.00","booking_id":2}',
                'read_at'         => '2025-01-31 18:32:31',
                'created_at'      => '2025-01-31 17:48:25',
                'updated_at'      => '2025-01-31 18:32:31',
            ],
            [
                'id'              => 'c4fc8376-37b7-4551-9205-b92e8f10937c',
                'type'            => 'App\\Notifications\\BookingNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id'   => 6,
                'data'            => '{"message":"New booking created by a client","booking_id":3,"user_service_id":20,"service_type":"mobile_services","appointment_date":"2027-12-31T00:00:00.000000Z","appointment_time":"7:00 PM"}',
                'read_at'         => null,
                'created_at'      => '2025-01-31 17:45:34',
                'updated_at'      => '2025-01-31 17:45:34',
            ],
        ]);
    }
}
