<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
