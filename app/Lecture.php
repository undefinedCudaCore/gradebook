<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    public function lectureGrades()
    {
        return $this->hasMany('App\Grade', 'lecture_id', 'id');
    }
}
