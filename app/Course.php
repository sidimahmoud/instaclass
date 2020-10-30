<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function status()
    {
        return $this->belongsTo('App\CourseStatus');
    }

//    public function enrollments()
//    {
//        return $this->hasMany('App\Enrollment');
//    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function sections()
    {
        return $this->hasMany('App\CourseFile');
    }

    public function sub()
    {
        return $this->belongsTo(SubCategory::class, 'category_id');
    }

    public function scopePriceLessThan(Builder $query, $price): Builder
    {
        return $query->with('subCategory.category', 'sections')->where('price', '<=', $price*100);
    }

    public function scopeInCategory(Builder $query, $id): Builder
    {
        return $query->with('subCategory.category', 'sections')->whereIn('sub_category_id', Category::find($id)->subCategories()->get('id'))->get();
    }
    public function scopeSectionCount(Builder $query, $count): Builder
    {
        return $query->with('subCategory.category', 'sections')->whereHas('sub_category_id', Category::find($id)->subCategories()->get('id'))->get();
    }

}
