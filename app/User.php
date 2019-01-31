<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
        // 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];


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

    public function student()
    {
        return $this->hasOne('App\Student', 'id');
    }

    /**
     * This method is to change email which is a base element which is to 
     * find a exact passport to another element, such as user id, name or number.
     */
    // public function findForPassport($username) {
    //     return $this->where('first_name', $username)->first();
    // }
}
