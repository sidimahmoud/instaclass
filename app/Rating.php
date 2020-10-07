<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }


    public function file()
    {
        return $this->belongsTo('App\CourseFile');
    }
}
