<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'listing_id', 'time', 'date', 'result'
    ];

    // get the listing associated with appointment
    function listing(){
        return $this->belongsTo('App\Listing');
    }

}
