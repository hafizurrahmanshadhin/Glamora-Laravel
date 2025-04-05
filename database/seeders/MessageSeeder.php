<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder {
    public function run(): void {
        DB::table('messages')->insert([
            [
                'id'          => 1,
                'sender_id'   => 2,
                'receiver_id' => 3,
                'message'     => 'Hello Beauty Expert!',
                'status'      => 'active',
                'created_at'  => '2025-04-05 11:53:57',
                'updated_at'  => '2025-04-05 11:53:57',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'sender_id'   => 3,
                'receiver_id' => 2,
                'message'     => 'Hi Client!',
                'status'      => 'active',
                'created_at'  => '2025-04-05 11:54:06',
                'updated_at'  => '2025-04-05 11:54:06',
                'deleted_at'  => null,
            ],
        ]);
    }
}
