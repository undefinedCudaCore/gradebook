<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function studentGrades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'id');
    }
}
