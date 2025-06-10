<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSSeeder extends Seeder {
    public function run(): void {
        DB::table('c_m_s')->insert([
            [
                'id'          => 1,
                'section'     => 'questionnaires',
                'title'       => 'Answer a few quick questions to start building your profile and get started',
                'description' => '<p>All information will be reviewed by our team to ensure compliance and maintain platform standards. Rest assured, your privacy and data security are our top priority.</p>',
                'image'       => null,
                'status'      => 'active',
                'created_at'  => '2025-06-10 06:13:55',
                'updated_at'  => '2025-06-10 06:13:55',
            ],
            [
                'id'          => 2,
                'section'     => 'join_us',
                'title'       => 'Discover Beauty Services',
                'description' => '<p>Step into a world of top-rated beauty professionals ready to cater to your unique needs. Whether you\'re looking for a new look or routine care, our platform connects you with the best beauty experts in your area. Explore a variety of services and easily book appointments that fit your schedule.</p>',
                'image'       => null,
                'status'      => 'active',
                'created_at'  => '2025-06-10 06:15:41',
                'updated_at'  => '2025-06-10 06:15:41',
            ],
            [
                'id'          => 3,
                'section'     => 'user-type-container',
                'title'       => 'I\'m a Beauty Professional',
                'description' => '<p>Join our platform to showcase your skills, connect with clients, and grow your beauty business. Benefit from secure payments and flexible scheduling.</p>',
                'image'       => 'frontend/uploads/home-user-type-1.png',
                'status'      => 'active',
                'created_at'  => null,
                'updated_at'  => '2025-06-10 06:19:10',
            ],
            [
                'id'          => 4,
                'section'     => 'user-type-container',
                'title'       => 'I\'m Looking for a Beauty Service',
                'description' => '<p>Find trusted beauty professionals near you, book an appointment for your next glam session, and experience top-tier service right at your convenience.</p>',
                'image'       => 'frontend/uploads/home-user-type-2.png',
                'status'      => 'active',
                'created_at'  => null,
                'updated_at'  => '2025-06-10 06:18:42',
            ],
        ]);
    }
}
