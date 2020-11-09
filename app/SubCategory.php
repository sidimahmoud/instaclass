<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Course;

class SubCategory extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
}
