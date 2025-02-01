<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder {
    public function run(): void {
        DB::table('contacts')->insert([
            [
                'id'           => 1,
                'name'         => 'Rashad Byrd',
                'email'        => 'vynijew@mailinator.com',
                'phone_number' => '+1 (358) 799-7767',
                'message'      => 'Voluptatem rem qui o',
                'status'       => 'active',
                'created_at'   => '2025-01-23 00:43:29',
                'updated_at'   => '2025-01-23 00:43:29',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'name'         => 'Jeanette Strong',
                'email'        => 'mikidowu@mailinator.com',
                'phone_number' => '+1 (824) 182-1946',
                'message'      => 'Aut deserunt natus c',
                'status'       => 'active',
                'created_at'   => '2025-01-23 00:43:31',
                'updated_at'   => '2025-01-23 00:43:31',
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'name'         => 'Delilah Short',
                'email'        => 'gawamu@mailinator.com',
                'phone_number' => '+1 (608) 919-3713',
                'message'      => 'Tempora velit fuga',
                'status'       => 'active',
                'created_at'   => '2025-01-23 00:43:34',
                'updated_at'   => '2025-01-23 00:43:34',
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'name'         => 'Aurelia Dickerson',
                'email'        => 'paliko@mailinator.com',
                'phone_number' => '+1 (946) 518-8214',
                'message'      => 'Molestiae labore atq',
                'status'       => 'active',
                'created_at'   => '2025-01-23 00:43:36',
                'updated_at'   => '2025-01-23 00:43:36',
                'deleted_at'   => null,
            ],
            [
                'id'           => 5,
                'name'         => 'Clark Casey',
                'email'        => 'jyrisysili@mailinator.com',
                'phone_number' => '+1 (764) 407-8268',
                'message'      => 'Deserunt sunt cillum',
                'status'       => 'active',
                'created_at'   => '2025-01-23 00:43:38',
                'updated_at'   => '2025-01-23 00:43:38',
                'deleted_at'   => null,
            ],
        ]);
    }
}
