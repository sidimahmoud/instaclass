<?php

use App\CourseStatus;
use Illuminate\Database\Seeder;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            CourseStatus::truncate();
            CourseStatus::create(['status' =>'free']);
            CourseStatus::create(['status' =>'paid']);
        }
    }
}
