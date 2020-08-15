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
            'name' => 'Full Stack Laravel',
            'user_id' => '2',
            'short_description' => 'Learn how to build web apps with larvel ',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png',
            'slug' => "full-stack-laravel-vue",
            'sub_category_id' => '1',
            'status' => '1',
            'type' => '1',
            'price' => '0.00',
            'created_at' => Carbon::now(),
        ]);
        Course::create([
            'name' => 'Build PWA with vue',
            'user_id' => '2',
            'short_description' => 'Learn to build progressive web apps',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png',
            'slug' => "build-wpa-with-vue",
            'sub_category_id' => '1',
            'status' => '2',
            'type' => '1',
            'price' => '10.99',
            'created_at' => Carbon::now(),
        ]);
    }
}
