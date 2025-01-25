<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'created_at'         => Carbon::parse('2025-01-23 00:40:06'),
                'updated_at'         => Carbon::parse('2025-01-23 00:40:06'),
                'deleted_at'         => null,
            ],
        ]);
    }
}
