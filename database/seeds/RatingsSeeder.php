<?php

use App\Rating;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::truncate();
        Rating::create([
            'course_id' => '2',
            'user_id' => '3',
            'rate' => '4',
            'review' => 'Jose is by far one of the best instructors I had the pleasure and opportunity to learn from. I highly recommend this course for any beginner',
        ]);
    }
}
