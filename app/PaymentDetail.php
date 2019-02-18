<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_detail';

    public $timestamps = false;

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function attribute()
    {
        return $this->hasMany('App\PaymentDetailAttribute', 'payment_detail_id');
    }
}
