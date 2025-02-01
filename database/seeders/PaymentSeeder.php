<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder {
    public function run(): void {
        DB::table('payments')->insert([
            [
                'id'                => 1,
                'user_id'           => 2,
                'booking_id'        => 1,
                'amount'            => 32.40,
                'currency'          => 'USD',
                'payment_status'    => 'completed',
                'stripe_payment_id' => null,
                'status'            => 'active',
                'created_at'        => '2025-01-31 17:47:28',
                'updated_at'        => '2025-01-31 17:47:28',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'user_id'           => 2,
                'booking_id'        => 2,
                'amount'            => 240.00,
                'currency'          => 'USD',
                'payment_status'    => 'completed',
                'stripe_payment_id' => null,
                'status'            => 'active',
                'created_at'        => '2025-01-31 17:49:49',
                'updated_at'        => '2025-01-31 17:49:49',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'user_id'           => 4,
                'booking_id'        => 5,
                'amount'            => 540.00,
                'currency'          => 'USD',
                'payment_status'    => 'completed',
                'stripe_payment_id' => null,
                'status'            => 'active',
                'created_at'        => '2025-02-01 04:01:51',
                'updated_at'        => '2025-02-01 04:01:51',
                'deleted_at'        => null,
            ],
            [
                'id'                => 4,
                'user_id'           => 2,
                'booking_id'        => 2,
                'amount'            => 240.00,
                'currency'          => 'USD',
                'payment_status'    => 'completed',
                'stripe_payment_id' => null,
                'status'            => 'active',
                'created_at'        => '2025-02-01 04:07:10',
                'updated_at'        => '2025-02-01 04:07:10',
                'deleted_at'        => null,
            ],
        ]);
    }
}
