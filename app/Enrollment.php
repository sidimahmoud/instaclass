<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\CourseFile');
    }

    public function payement()
    {
        return $this->hasOne('App\Payement');
    }
}
