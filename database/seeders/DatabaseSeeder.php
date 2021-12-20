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
        $this->call([
            QuestionTypeSeeder::class,
            StudentSeeder::class,
            AdminSeeder::class,
            InstructorSeeder::class,
        ]);
        Course::factory()->count(5)->has(Test::factory()
            ->count(5),'tests')
            ->has(Student::factory()
                ->count(15),'students')
            ->create();
    }
}
