<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGallerySeeder extends Seeder {
    public function run(): void {
        $data = [
            [
                'id'         => 1,
                'user_id'    => 3,
                'image'      => 'frontend/service-image-22.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:15:44',
                'updated_at' => '2025-02-18 06:15:44',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'user_id'    => 3,
                'image'      => 'frontend/service-image-22.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:15:49',
                'updated_at' => '2025-02-18 06:15:49',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'user_id'    => 3,
                'image'      => 'frontend/service-image-22.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:15:53',
                'updated_at' => '2025-02-18 06:15:53',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'user_id'    => 3,
                'image'      => 'frontend/service-image-22.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:15:57',
                'updated_at' => '2025-02-18 06:15:57',
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'user_id'    => 5,
                'image'      => 'frontend/service-image2.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:16:51',
                'updated_at' => '2025-02-18 06:16:51',
                'deleted_at' => null,
            ],
            [
                'id'         => 6,
                'user_id'    => 5,
                'image'      => 'frontend/service-image2.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:16:55',
                'updated_at' => '2025-02-18 06:16:55',
                'deleted_at' => null,
            ],
            [
                'id'         => 7,
                'user_id'    => 5,
                'image'      => 'frontend/service-image2.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:16:59',
                'updated_at' => '2025-02-18 06:16:59',
                'deleted_at' => null,
            ],
            [
                'id'         => 8,
                'user_id'    => 5,
                'image'      => 'frontend/service-image2.jpg',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:17:02',
                'updated_at' => '2025-02-18 06:17:02',
                'deleted_at' => null,
            ],
            [
                'id'         => 9,
                'user_id'    => 6,
                'image'      => 'frontend/home-user-type-22.png',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:17:35',
                'updated_at' => '2025-02-18 06:17:35',
                'deleted_at' => null,
            ],
            [
                'id'         => 10,
                'user_id'    => 6,
                'image'      => 'frontend/home-user-type-22.png',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:17:39',
                'updated_at' => '2025-02-18 06:17:39',
                'deleted_at' => null,
            ],
            [
                'id'         => 11,
                'user_id'    => 6,
                'image'      => 'frontend/home-user-type-22.png',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:17:42',
                'updated_at' => '2025-02-18 06:17:42',
                'deleted_at' => null,
            ],
            [
                'id'         => 12,
                'user_id'    => 6,
                'image'      => 'frontend/home-user-type-22.png',
                'status'     => 'active',
                'created_at' => '2025-02-18 06:17:46',
                'updated_at' => '2025-02-18 06:17:46',
                'deleted_at' => null,
            ],
        ];

        DB::table('user_galleries')->insert($data);
    }
}
