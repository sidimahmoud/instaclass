<?php

use App\CourseFile;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseFile::truncate();
        CourseFile::create([
            'number' => 1,
            'course_id' => 1,
            'title' => "First section",
            'description' => "lorem lorem lorem ",
            'startDate' => "10-12-2020",
            'duration' => "45min",
        ]);
    }
}
