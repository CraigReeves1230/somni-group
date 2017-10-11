<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'address_id', 'agent', 'agent_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // gets the listings for a user
    function listings(){
        return $this->hasMany('App\Listing');
    }

    // returns the phone number for user
    function phone_number(){
        return $this->belongsTo('App\PhoneNumber');
    }

    // get the address for user
    function address(){
        return $this->belongsTo('App\Address');
    }

}
