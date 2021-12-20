<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'unique_id' => Str::random(10),
            'title' => Str::random(10),
            'instructor_id' => 1,
            'description' => Str::random(50),
            'started_at' => '2021-10-10 10:00:00',
            'ended_At' => '2022-10-10 10:00:00'
        ]);
    }
}
