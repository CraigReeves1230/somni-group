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

    // returns phone number formatted US/Canada style
    function formatted_number(){
        $phone_number = "({$this->area_code}) " . substr_replace($this->number, '-', 3, 0);
        return $phone_number;
    }
}
