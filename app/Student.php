<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    public $timestamps = false;

    protected $appends = [
        'full_name',
        'type',
        'status'
    ];

    
    public function getTypeAttribute($value)
    {
        return SelectionOption::where('group', 'student_type')->where('value', $this->type_id)->first();
    }

    public function getStatusAttribute($value)
    {
        return SelectionOption::where('group', 'student_status')->where('value', $this->status_id)->first();
    }

    public function address()
    {
        return $this->hasMany('App\Address', 'student_id');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact', 'student_id');
    }

    public function emergency_contact()
    {
        return $this->hasMany('App\EmergencyContact', 'student_id');
    }

    // public function status()
    // {
    //     return $this->belongsTo('App\Category', 'status_id');
    // }


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

    public function program()
    {
        return $this->hasMany('App\Program');
    }

    public function leaves()
    {
        return $this->hasMany('App\Leave')->whereNull('deleted_at');
    }

    public function getFullNameAttribute($value)
    {
        $full_name = $this->first_name;
        if ($this->middle_name) {
            $full_name .= ' ' . $this->middle_name;
        }

        if($this->last_name) {
            $full_name .= ' ' . $this->last_name;
        }

        return $full_name;
    }

    public function getPurchasedProgramsAttribute($value)
    {
        $payments = $this->payment()->whereNull('deleted_at')->get();

        $result = [];
        foreach ($payments as $payment) {
            foreach ($payment->payment_detail as $item) {
                if ($item->attribute()->where('attribute_id', 1)->first()) {
                    if ($item->attribute()->where('attribute_id', 1)->first()->value->id === 1) {
                        $result[] = $item;
                    }    
                }
            }
        }

        return $result;
    }

    // public function purchased_programs()
    // {
    //     $payments = $this->hasMany('App\Payment')->get();

    //     $result = [];
    //     foreach ($payments as $payment) {
    //         foreach ($payment->payment_detail()->get() as $item) {
    //             if ($item->product->category_id === 1) {
    //                 // The category is "Type"
    //                 if ($item->attribute()->where('attribute_id', 1)->first()) {
    //                     if ($item->attribute()->where('attribute_id', 1)->first()->value->id === 1) {
    //                         $result[] = $item;
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $result;
    // }

    // public function programs_taken()
    // {

    //     $payments = $this->hasMany('App\Payment')->get();
    //     $programs_taken = [];
    //     foreach($payments as $payment) {
    //         if($payment->status === 'Waiting' || $payment->status === 'Paid') {
    //             $items_in_payment = $payment->product()->get();
    //             $filtered = $items_in_payment->filter(function ($value, $key) {
    //                 if (!$value->pivot->is_refunded) {
    //                     return $value->category === 'program';
    //                 }
    //             });

    //             $programs_taken = array_merge($programs_taken, $filtered->all());    
    //         }
    //     }

    //     return $programs_taken;
    // }

}
