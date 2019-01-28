<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leave';

    public $timestamps = false;

    public function program()
    {
        return $this->belongsToMany('App\Program', 'link_leave_program', 'leave_id', 'program_id');
    }

    public function leave_type()
    {
      return $this->belongsTo('App\Category', 'leave_type_id')->where('group', 'leave_type');
    }
}
