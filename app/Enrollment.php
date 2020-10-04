<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function CourseFile()
    {
        return $this->belongsTo(CourseFile::class);
    }

    public function payment()
    {
        return $this->hasOne('App\Payement');
    }
}
