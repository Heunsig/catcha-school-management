<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function payment_detail()
    {
        return $this->belongsTo('App\PaymentDetail', 'payment_detail_id');
    }

    public function program_date()
    {
        return $this->hasMany('App\ProgramDate')->whereNull('deleted_at');
    }

    public function class()
    {
        return $this->hasMany('App\ClassInProgram')->whereNull('deleted_at');
    }

    // public function scopeActiveProgramDate($query)
    // {
    //     // return $query->whereNull('program_date.deleted_at');
    // }
}
