<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    public function category(){
        return $this->belongsTo('App/Category');
    }
    public function courses(){
        return $this->hasMany('App/Course');
    }
}
