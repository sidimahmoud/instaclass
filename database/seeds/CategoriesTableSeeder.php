<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::create([
            'name' => 'WEB DEVELOPMENT',
            'description' => 'Some quick example text to build on the card title and make up the bulk of the cards content.',
            'created_at' => Carbon::now(),
        ]);
        Category::create([
            'name' => 'DATA SCIENCE',
            'description' => 'Some quick example text to build on the card title and make up the bulk of the cards content.',
            'created_at' => Carbon::now(),
        ]);
        Category::create([
            'name' => 'CLOUD COMPUTING',
            'description' => 'Some quick example text to build on the card title and make up the bulk of the cards content.',
            'created_at' => Carbon::now(),
        ]);
    }
}
