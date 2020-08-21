<?php

use App\Course;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::truncate();
        Course::create([
            'user_id' => '2',
            'category_id' => '1',
            'name' => 'Full Stack Laravel Vue',
            'short_description' => 'Learn how to build web apps with Larvel and Vue',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://instantclass.herokuapp.com/uploads/logo.png',
            'slug' => "full-stack-laravel-vue",
            'language' => 'EN',
            'duration' => '2H',
            'status' => '1',
            'type' => '1',
            'price' => '0.00',
            'paid' => '1',
            'created_at' => Carbon::now(),
        ]);

        Course::create([
            'name' => 'PWAs with Vuejs',
            'user_id' => '2',
            'short_description' => 'Learn how to build web apps with larvel ',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://instantclass.herokuapp.com/uploads/logo.png',
            'slug' => "pwas-with-vuejs",
            'category_id' => '1',
            'language' => 'EN',
            'duration' => '2H',
            'type' => '1',
            'status' => '2',
            'price' => '19.99',
            'paid' => '1',
            'created_at' => Carbon::now(),
        ]);

        Course::create([
            'name' => 'First live course',
            'user_id' => '2',
            'short_description' => 'Learn to lorem ipsum  ',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://instantclass.herokuapp.com/uploads/logo.png',
            'slug' => "first-live-course",
            'category_id' => '1',
            'language' => 'FR',
            'duration' => '1H',
            'type' => '2',
            'status' => '2',
            'price' => '10.00',
            'created_at' => Carbon::now(),
        ]);

    }
}
