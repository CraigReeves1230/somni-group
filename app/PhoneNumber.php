<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $fillable = [
        'area_code', 'number'
    ];

    // returns the users for a phone number
    function user(){
        return $this->hasOne('App\User');
    }
}
