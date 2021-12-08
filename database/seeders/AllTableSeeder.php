<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Test;
use Illuminate\Database\Seeder;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseStudent::factory(10)->make();
        Test::factory(10)->make();
        Admin::factory(1)->make();
    }
}
