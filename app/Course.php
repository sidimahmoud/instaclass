<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
use App\User;
use App\CourseStatus;
use App\Rating;
use App\CourseFile;

class Course extends Model
{
    protected $fillable = [
        'user_id',
        'sub_category_id',
        'name',
        'language',
        'is_free',
        'short_description'
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class);
    }

//    public function enrollments()
//    {
//        return $this->hasMany('App\Enrollment');
//    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseFile::class);
    }

    public function sub()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function scopePriceLessThan(Builder $query, $price): Builder
    {
        return $query->with('subCategory.category', 'sections')->where('price', '<=', $price);
    }

    public function scopeInCategory(Builder $query, $id): Builder
    {
        return $query->with('subCategory.category', 'sections')->whereIn('sub_category_id', Category::find($id)->subCategories()->get('id'));
    }

    public function scopeSectionCount(Builder $query, $count): Builder
    {
        //info($query->with('subCategory.category', 'sections')->withCount('sections')->having('sections_count', '=', $count)->get());
        return $query->with('subCategory.category', 'sections')->having('sections_count', '=', $count);
    }

}
