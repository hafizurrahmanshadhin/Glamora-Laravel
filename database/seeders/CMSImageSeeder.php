<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSImageSeeder extends Seeder {
    public function run(): void {
        DB::table('c_m_s_images')->insert([
            [
                'id'         => 1,
                'image'      => 'frontend/uploads/home-images/home-banner_1740888946.png',
                'page'       => 'home',
                'status'     => 'active',
                'created_at' => '2025-03-01 22:15:46',
                'updated_at' => '2025-03-01 22:15:46',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'image'      => 'frontend/uploads/home-images/home-banner_1740888954.png',
                'page'       => 'home',
                'status'     => 'active',
                'created_at' => '2025-03-01 22:15:54',
                'updated_at' => '2025-03-01 22:15:54',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'image'      => 'frontend/uploads/home-images/home-banner_1740888960.png',
                'page'       => 'home',
                'status'     => 'active',
                'created_at' => '2025-03-01 22:16:00',
                'updated_at' => '2025-03-01 22:16:00',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'image'      => 'frontend/uploads/auth-images/auth-banner_1740889150.png',
                'page'       => 'auth',
                'status'     => 'active',
                'created_at' => '2025-03-01 22:19:10',
                'updated_at' => '2025-03-01 22:19:10',
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'image'      => 'frontend/uploads/home-testimonial-img.png',
                'page'       => 'testimonial',
                'status'     => 'active',
                'created_at' => '2025-03-01 22:19:10',
                'updated_at' => '2025-03-01 22:19:10',
                'deleted_at' => null,
            ],
        ]);
    }
}
