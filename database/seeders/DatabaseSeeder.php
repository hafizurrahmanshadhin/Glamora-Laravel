<?php

namespace Database\Seeders;

use Database\Seeders\BusinessInformationSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\TravelRadiusSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserServiceSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
            SocialMediaSeeder::class,
            ContentSeeder::class,
            ServiceSeeder::class,
            FAQSeeder::class,
            ContactSeeder::class,
            BusinessInformationSeeder::class,
            TravelRadiusSeeder::class,
            UserServiceSeeder::class,
        ]);
    }
}
