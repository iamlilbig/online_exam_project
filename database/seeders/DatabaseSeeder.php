<?php

namespace Database\Seeders;

use \App\Models\Admin;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Test;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        CourseStudent::factory(10)->make();
        Test::factory(10)->make();
        Student::factory(10)->make();
        Instructor::factory(10)->make();
        Course::factory(10)->make();
        Admin::factory(1)->make();
    }
}
