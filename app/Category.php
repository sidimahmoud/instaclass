<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;

class Category extends Model
{
    protected $fillable = [
        'name_fr',
        'name_en',
    ];

    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
}
