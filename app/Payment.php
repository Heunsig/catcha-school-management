<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public $timestamps = false;

    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_key', 'key');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product', 
                                    'link_payment_product', 
                                    'payment_id', 
                                    'product_id')
                    ->withPivot([
                        'id',
                        'week',
                        // 'start_date',
                        // 'completion_date',
                        'price',
                        'quantity',
                        'note',
                        'is_refunded',
                    ]);
    }

    public function item()
    {
        return $this->hasMany('App\Item', 'payment_id');
    }

    public function credit_card_information()
    {
        return $this->hasMany('App\CreditCardInformation', 'payment_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
