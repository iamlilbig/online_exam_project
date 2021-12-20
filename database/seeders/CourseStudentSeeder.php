<?php

namespace Database\Seeders;

use App\Models\CourseStudent;
use Database\Factories\CourseStudentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseStudent::factory()->count(5)->create();
    }
}
