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
            'name' => 'Full Stack Laravel/Vue',
            'user_id' => '2',
            'short_description' => 'Learn how to build web apps with larvel and vue.js',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://i2.wp.com/wp.laravel-news.com/wp-content/uploads/2018/01/vue-spa-with-laravel.png?resize=2200%2C1125',
            'slug' => "full-stack-laravel-vue",
            'sub_category_id' => '1',
            'status' => '1',
            'price' => '0.00',
            'created_at' => Carbon::now(),
        ]);
        Course::create([
            'name' => 'Build PWA with vue',
            'user_id' => '2',
            'short_description' => 'Learn to build progressive web apps',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://i2.wp.com/wp.laravel-news.com/wp-content/uploads/2018/01/vue-spa-with-laravel.png?resize=2200%2C1125',
            'slug' => "build-wpa-with-vue",
            'sub_category_id' => '1',
            'status' => '2',
            'price' => '10.99',
            'created_at' => Carbon::now(),
        ]);
    }
}
