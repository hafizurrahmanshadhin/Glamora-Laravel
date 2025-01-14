<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClientsFeedbackSeeder extends Seeder {
    public function run(): void {
        //~ Temporarily disable foreign key checks to avoid constraints issues
        Schema::disableForeignKeyConstraints();

        //! Truncate the table to remove any existing data
        DB::table('clients_feedback')->truncate();

        //# Insert data into the clients_feedback table
        DB::table('clients_feedback')->insert([
            [
                'id'          => 1,
                'rating'      => 5,
                'description' => '<p>Brown Box has completely changed how I handle deliveries. I don’t have to worry about stolen packages or missed deliveries anymore it’s so reassuring to know my items are safe and waiting for me!</p>',
                'name'        => 'Sarah M.',
                'title'       => 'Founder @Envu',
                'status'      => 'active',
                'created_at'  => '2024-12-10 06:49:25',
                'updated_at'  => '2024-12-10 06:49:25',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'rating'      => 3,
                'description' => '<p>With my hectic schedule, I rarely have time to be home when packages arrive. Brown Box takes all the stress out of getting my orders delivered. I can pick them up whenever it works for me it’s a game-changer!</p>',
                'name'        => 'Tyler W.',
                'title'       => 'Founder @Monk',
                'status'      => 'active',
                'created_at'  => '2024-12-10 06:50:17',
                'updated_at'  => '2024-12-10 06:50:17',
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'rating'      => 4,
                'description' => '<p>I used to dread missing deliveries and having to track them down. With Brown Box, I know my packages are in good hands. It’s such a relief to have a secure place for them, especially with all my online shopping!</p>',
                'name'        => 'Amanda R.',
                'title'       => 'Founder @D.Agency',
                'status'      => 'active',
                'created_at'  => '2024-12-10 06:50:46',
                'updated_at'  => '2024-12-10 06:50:46',
                'deleted_at'  => null,
            ],
        ]);

        //$ Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
