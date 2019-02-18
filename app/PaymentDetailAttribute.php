<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetailAttribute extends Model
{
    protected $table = 'payment_detail_attribute';

    public $timestamps = false;

    protected $fillable = [
        'payment_detail_id',
        'attribute_id',
        'attribute_value_id'
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Attribute', 'attribute_id');
    }

    public function value()
    {
        return $this->belongsTo('App\AttributeValue', 'attribute_value_id');
    }
}
