<?php

use App\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enrollment::truncate();
        Enrollment::create([
            'user_id' => '3',
            'course_id' => '2',
        ]);
        Enrollment::create([
            'user_id' => '3',
            'course_id' => '3',
        ]);
    }
}
