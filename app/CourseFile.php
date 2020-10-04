<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
