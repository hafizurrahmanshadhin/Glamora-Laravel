<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessInformationSeeder extends Seeder {
    public function run(): void {
        DB::table('business_information')->insert([
            [
                'id'                 => 1,
                'user_id'            => 3,
                'avatar'             => 'frontend/service-image-2.jpg',
                'name'               => 'beauty-expert',
                'bio'                => 'With over 10 years of experience in bridal makeup and hairstyling, Sophia Green is dedicated to enhancing your natural beauty on your special day. Whether it’s a timeless classic look or a more contemporary style, Sophia tailors each service to meet your individual needs, ensuring a flawless finish.',
                'business_name'      => 'beauty-expert',
                'business_address'   => 'Dhaka, Bangladesh',
                'professional_title' => 'Software Engineer',
                'license'            => 'frontend/service-image-2.jpg',
                'status'             => 'active',
                'created_at'         => '2025-01-22 18:40:06',
                'updated_at'         => '2025-01-23 18:45:06',
                'deleted_at'         => null,
            ],
            [
                'id'                 => 2,
                'user_id'            => 5,
                'avatar'             => 'frontend/dashboard-profile.png',
                'name'               => 'test',
                'bio'                => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'business_name'      => 'test',
                'business_address'   => 'Dhaka',
                'professional_title' => 'Beauty Expert',
                'license'            => 'frontend/dashboard-profile.png',
                'status'             => 'active',
                'created_at'         => '2025-02-14 23:33:33',
                'updated_at'         => '2025-03-16 23:38:33',
                'deleted_at'         => null,
            ],
            [
                'id'                 => 3,
                'user_id'            => 6,
                'avatar'             => 'frontend/comment-author.jpg',
                'name'               => 'Hafizur Rahman Shadhin',
                'bio'                => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'business_name'      => 'Shadhin',
                'business_address'   => 'Mohammadpur, Dhaka',
                'professional_title' => 'Software Engineer',
                'license'            => 'frontend/comment-author.jpg',
                'status'             => 'active',
                'created_at'         => '2025-04-08 23:38:19',
                'updated_at'         => '2025-04-19 23:38:19',
                'deleted_at'         => null,
            ],
        ]);
    }
}
