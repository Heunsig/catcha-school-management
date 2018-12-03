<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classinfo extends Model
{
    protected $table = 'classinfo';

    public function student()
    {
        return $this->belongsToMany('App\Student', 
                                    'link_class_student', 
                                    'classinfo_id', 
                                    'student_id');
    }
}
