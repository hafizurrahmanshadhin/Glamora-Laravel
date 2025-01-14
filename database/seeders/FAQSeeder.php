<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder {
    public function run(): void {
        DB::table('f_a_q_s')->insert([
            [
                'id'         => 1,
                'question'   => 'Question-1',
                'answer'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maxime beatae earum ea harum, velit dolor? Animi facere officiis quae id maiores dolore tempore nam, modi praesentium quos fuga quas?',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'question'   => 'Question-2',
                'answer'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maxime beatae earum ea harum, velit dolor? Animi facere officiis quae id maiores dolore tempore nam, modi praesentium quos fuga quas?',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'question'   => 'Question-3',
                'answer'     => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maxime beatae earum ea harum, velit dolor? Animi facere officiis quae id maiores dolore tempore nam, modi praesentium quos fuga quas?',
                'status'     => 'active',
                'created_at' => '2024-09-13 03:52:56',
                'updated_at' => '2024-09-13 03:52:56',
                'deleted_at' => null,
            ],
        ]);

        //* Optionally reset AUTO_INCREMENT value
        DB::statement('ALTER TABLE f_a_q_s AUTO_INCREMENT = 4;');
    }
}
