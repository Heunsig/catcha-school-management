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

    public function status()
    {
        return $this->belongsTo('App\Category', 'status_id');
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
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'created_by',
                        'updated_by',
                        'deleted_by'
                    ]);
                    // ->withPivot([
                    //     'id',
                    //     'start_date',
                    //     'completion_date',
                    //     'program_id',
                    //     'created_by',
                    //     'updated_by',
                    //     'deleted_by',
                    //     'deleted_at'
                    // ])
                    // ->withTimestamps();
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    public function programs_taken()
    {

        $payments = $this->hasMany('App\Payment')->get();
        $programs_taken = [];
        foreach($payments as $payment) {
            if($payment->status === 'Waiting' || $payment->status === 'Paid') {
                $items_in_payment = $payment->product()->get();
                $filtered = $items_in_payment->filter(function ($value, $key) {
                    if (!$value->pivot->is_refunded) {
                        return $value->category === 'program';
                    }
                });

                $programs_taken = array_merge($programs_taken, $filtered->all());    
            }
        }

        return $programs_taken;
    }
}
