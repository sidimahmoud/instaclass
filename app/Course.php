<?php

namespace App;

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

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function sections()
    {
        return $this->hasMany('App\CourseFile');
    }
}
