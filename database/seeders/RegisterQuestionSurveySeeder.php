<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegisterQuestionSurveySeeder extends Seeder {
    public function run(): void {
        DB::table('register_question_surveys')->insert([
            [
                'id'          => 1,
                'description' => '<p>Answer a few questions and start building your profile</p>',
                'status'      => 'active',
                'created_at'  => '2025-06-10 06:14:09',
                'updated_at'  => '2025-06-10 06:14:09',
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'description' => '<p>Upload your certifications and professional details to ensure trust</p>',
                'status'      => 'active',
                'created_at'  => '2025-06-10 06:14:21',
                'updated_at'  => '2025-06-10 06:14:21',
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'description' => '<p>Get paid safely and know we\'re there to help</p>',
                'status'      => 'active',
                'created_at'  => '2025-06-10 06:14:31',
                'updated_at'  => '2025-06-10 06:14:37',
                'deleted_at'  => null,
            ],
        ]);
    }
}
