<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminCommentSeeder extends Seeder {
    public function run(): void {
        DB::table('admin_comments')->insert([
            [
                'id'         => 1,
                'user_id'    => 5,
                'comment'    => 'Banned by glamora admin',
                'status'     => 'active',
                'created_at' => '2025-03-16 03:15:13',
                'updated_at' => '2025-03-16 03:15:13',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'user_id'    => 3,
                'comment'    => 'I found the perfect makeup artist for my wedding through this platform! The entire process was smooth, and the artist was professional and talented. I couldn\'t have asked for a better experience!',
                'status'     => 'active',
                'created_at' => '2025-03-16 03:15:57',
                'updated_at' => '2025-03-16 03:15:57',
                'deleted_at' => null,
            ],
        ]);
    }
}
