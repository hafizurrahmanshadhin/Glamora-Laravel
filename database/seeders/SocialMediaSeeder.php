<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder {
    public function run(): void {
        DB::table('social_media')->insert([
            [
                'id'           => 1,
                'social_media' => 'facebook',
                'profile_link' => 'https://www.facebook.com/',
                'created_at'   => '2025-02-19 00:03:21',
                'updated_at'   => '2025-03-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'social_media' => 'instagram',
                'profile_link' => 'https://www.instagram.com/',
                'created_at'   => '2025-04-19 00:03:21',
                'updated_at'   => '2025-05-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'social_media' => 'twitter',
                'profile_link' => 'https://x.com/',
                'created_at'   => '2025-06-19 00:03:21',
                'updated_at'   => '2025-07-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'social_media' => 'linkedin',
                'profile_link' => 'https://www.linkedin.com/',
                'created_at'   => '2025-08-19 00:03:21',
                'updated_at'   => '2025-09-19 00:03:21',
                'deleted_at'   => null,
            ],
        ]);
    }
}
