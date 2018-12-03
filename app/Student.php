<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\User', 'id');
    }

    public function classinfo()
    {
        return $this->belongsToMany('App\Classinfo', 
                                    'link_class_student', 
                                    'student_id', 
                                    'classinfo_id')
                    ->withPivot([
                        'id',
                        'start_date',
                        'completion_date',
                        'group',
                        'created_by',
                        'updated_by',
                        'deleted_by',
                        'deleted_at'
                    ])
                    ->withTimestamps();
    }
}
