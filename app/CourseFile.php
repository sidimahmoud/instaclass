<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    protected $fillable = [
        'startDate',
    ];
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
