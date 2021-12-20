<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
            'name' => 'mohamad hasan',
            'email' => 'mohamadhasan11773@gmail.com',
            'password' => Hash::make('11338822'),
            'phone' =>'09031498992',
            'is_active' => 1,
            'is_confirmed' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
