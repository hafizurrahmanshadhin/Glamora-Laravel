<?php

namespace Database\Seeders;

use Database\Seeders\ClientsFeedbackSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
            SocialMediaSeeder::class,
            FAQSeeder::class,
            ContentSeeder::class,
            ClientsFeedbackSeeder::class,
        ]);
    }
}
