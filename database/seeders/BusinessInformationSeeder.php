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
                'name'               => 'Sophia Grace',
                'bio'                => 'Sophia Grace',
                'business_name'      => 'Sophia Grace',
                'professional_title' => 'Sophia Grace',
                'license'            => 'frontend/service-image-2.jpg',
                'status'             => 'active',
                'created_at'         => Carbon::parse('2025-01-23 00:40:06'),
                'updated_at'         => Carbon::parse('2025-01-23 00:40:06'),
                'deleted_at'         => null,
            ],
        ]);
    }
}
