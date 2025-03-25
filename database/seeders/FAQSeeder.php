<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder {
    public function run(): void {
        DB::table('f_a_q_s')->insert([
            [
                'id'         => 1,
                'question'   => 'How does TAXDAX help me find new clients?',
                'answer'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et felis vel nisi consectetur aliquet. Aenean vehicula, urna nec aliquet volutpat, augue turpis suscipit lacus, sit amet sodales libero odio nec mauris. Vivamus consequat, lectus a tincidunt interdum, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et felis vel nisi consectetur aliquet. Aenean vehicula, urna nec aliquet volutpat, augue turpis suscipit lacus, sit amet sodales libero odio nec mauris. Vivamus consequat, lectus a tincidunt interdum,',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'question'   => 'How do I manage my appointments?',
                'answer'     => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beata',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'question'   => 'Is there a fee to join?',
                'answer'     => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'question'   => 'How secure is the platform for document sharing?',
                'answer'     => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
        ]);
    }
}
