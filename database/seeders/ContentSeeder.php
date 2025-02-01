<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder {
    public function run(): void {
        DB::table('contents')->insert([
            [
                'id'         => 1,
                'type'       => 'termsAndConditions',
                'title'      => 'Terms & Conditions',
                'slug'       => 'terms-conditions',
                'content'    => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                'status'     => 'active',
                'created_at' => '2025-01-11 23:37:30',
                'updated_at' => '2025-01-12 23:40:33',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'type'       => 'privacyPolicy',
                'title'      => 'Privacy Policy',
                'slug'       => 'privacy-policy',
                'content'    => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
                'status'     => 'active',
                'created_at' => '2025-01-14 23:37:30',
                'updated_at' => '2025-01-15 23:40:33',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'type'       => 'inclusionsCancellation',
                'title'      => 'Inclusions & Cancellation',
                'slug'       => 'inclusions-cancellation',
                'content'    => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
                'status'     => 'active',
                'created_at' => '2025-01-21 23:37:30',
                'updated_at' => '2025-01-22 23:40:33',
                'deleted_at' => null,
            ],
        ]);
    }
}
