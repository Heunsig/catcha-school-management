<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCardInformation extends Model
{
    protected $table = 'credit_card_information';

    protected $fillable = [
        'card_numbers',
        'name_on_card',
        'expiration_month',
        'expiration_year'
    ];

    public $timestamps = false;
}
