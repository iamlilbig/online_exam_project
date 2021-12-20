<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert([
            'question_type' => 'descriptive',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('question_types')->insert([
            'question_type' => 'multiple Choice',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
