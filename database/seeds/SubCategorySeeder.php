<?php

use App\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::truncate();
        SubCategory::create([
            'category_id' => 1,
            'name_en' => 'Test',
            'name_fr' => 'Teste',
            'created_at' => Carbon::now(),
        ]);
    }
}
