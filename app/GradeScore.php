<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeScore extends Model
{
    protected $table = 'grade_score';

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function grade_group()
    {
        return $this->belongsTo('App\GradeGroup', 'grade_group_id');
    }
}
