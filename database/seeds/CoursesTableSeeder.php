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
            'name' => 'Full Stack Laravel Vue',
            'user_id' => '2',
            'short_description' => 'Learn how to build web apps with Larvel and Vue',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://www.log2e.com/wp-content/uploads/2019/01/vuejs_tutorial.png',
            'slug' => "full-stack-laravel-vue",
            'category_id' => '1',
            'status' => '1',
            'language' => 'EN',
            'duration' => '2H',
            'type' => '1',
            'price' => '0.00',
            'created_at' => Carbon::now(),
        ]);

        Course::create([
            'name' => 'PWAs with Vuejs',
            'user_id' => '2',
            'short_description' => 'Learn how to build web apps with larvel ',
            'description' => '  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor inr',
            'image' => 'https://www.log2e.com/wp-content/uploads/2019/01/vuejs_tutorial.png',
            'slug' => "pwas-with-vuejs",
            'category_id' => '1',
            'status' => '2',
            'language' => 'EN',
            'duration' => '2H',
            'type' => '2',
            'price' => '19.99',
            'created_at' => Carbon::now(),
        ]);

    }
}
