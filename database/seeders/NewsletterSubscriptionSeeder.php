<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsletterSubscriptionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('newsletter_subscriptions')->insert([
            [
                'id'         => 1,
                'email'      => 'fyzyjar@mailinator.com',
                'status'     => 'active',
                'created_at' => '2025-02-16 05:58:51',
                'updated_at' => '2025-02-16 05:58:51',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'email'      => 'voca@mailinator.com',
                'status'     => 'active',
                'created_at' => '2025-02-16 06:02:33',
                'updated_at' => '2025-02-16 06:02:33',
                'deleted_at' => null,
            ],
        ]);
    }
}
