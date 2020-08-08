<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStatus extends Model
{
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
