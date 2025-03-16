<?php

namespace Database\Seeders;

use Database\Seeders\AdminCommentSeeder;
use Database\Seeders\BookingCancellationAfterAppointmentSeeder;
use Database\Seeders\BookingCancellationBeforeAppointmentSeeder;
use Database\Seeders\BookingSeeder;
use Database\Seeders\BusinessInformationSeeder;
use Database\Seeders\CMSImageSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\DynamicPageSeeder;
use Database\Seeders\FAQSeeder;
use Database\Seeders\NewsletterSubscriptionSeeder;
use Database\Seeders\NotificationsSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\PaymentSeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SocialMediaSeeder;
use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\TravelRadiusSeeder;
use Database\Seeders\UserGallerySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserServiceSeeder;
use Database\Seeders\UserToolSeeder;
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
            BookingSeeder::class,
            ReviewSeeder::class,
            ReportSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
            NotificationsSeeder::class,
            NewsletterSubscriptionSeeder::class,
            UserToolSeeder::class,
            UserGallerySeeder::class,
            CMSImageSeeder::class,
            BookingCancellationBeforeAppointmentSeeder::class,
            BookingCancellationAfterAppointmentSeeder::class,
            AdminCommentSeeder::class,
        ]);
    }
}
