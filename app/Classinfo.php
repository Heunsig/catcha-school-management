<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classinfo extends Model
{
    protected $table = 'classinfo';

    public $timestamps = false;

    public function students()
    {
        return $this->belongsToMany('App\Student', 
                                    'link_class_student', 
                                    'classinfo_id', 
                                    'student_id')
                    ->withPivot('classinfo_id', 'student_id', 'start_date')
                    ->whereNull('student.deleted_at')
                    ->whereNull('completion_date');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'link_class_subject', 'classinfo_id', 'subject_id');
    }

    public function grade_groups()
    {
        return $this->belongsToMany('App\GradeGroup', 'link_class_grade_group', 'classinfo_id', 'grade_group_id');
    }
}
