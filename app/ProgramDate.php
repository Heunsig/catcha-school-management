<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramDate extends Model
{
    protected $table = 'program_date';

    public $timestamps = false;

    protected $fillable = [
        'start_date',
        'completion_date',
        'reason',
        'deleted_at',
        'deleted_by'
    ];

    public function program()
    {
        return $this->belongsTo('App\Program', 'program_id');
    }
}
