<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsToMany('App\Attribute', 'link_product_attribute', 'product_id', 'attribute_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    // protected $fillable = ['children'];
}
