<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function program_date()
    {
        return $this->hasMany('App\ProgramDate');
    }

    public function class()
    {
        return $this->hasMany('App\ClassInProgram');
    }
}
