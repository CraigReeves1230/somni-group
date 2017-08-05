<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'latitude', 'longitude', 'address_id'
    ];

    function address(){
        return $this->belongsTo('App\Address');
    }
}
