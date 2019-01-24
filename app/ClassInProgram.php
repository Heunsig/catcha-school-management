<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassInProgram extends Model
{
    protected $table = 'link_class_student';

    public $timestamps = false;

    protected $fillable = [
        'classinfo_id',
        'student_id',
        'start_date',
        'completion_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function classinfo()
    {
        return $this->belongsTo('App\Classinfo');
    }
}
