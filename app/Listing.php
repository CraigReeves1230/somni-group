<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title', 'type', 'price', 'bedrooms', 'bathrooms',
        'area', 'mls', 'location', 'address', 'city', 'zip',
        'description', 'profile'
    ];

    // gets the user for a listing
    function user(){
        return $this->belongsTo('App\User');
    }

    // get images
    function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    // get address
    function address(){
        return $this->belongsTo('App\Address');
    }
}
