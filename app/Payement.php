<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enrollment()
    {
        return $this->belongsTo('App\Enrollment');
    }
}
