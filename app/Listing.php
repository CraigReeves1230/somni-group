<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title', 'type', 'price', 'bedrooms', 'bathrooms',
        'area', 'mls', 'location', 'address', 'city', 'zip',
        'description'
    ];

    // gets the user for a listing
    function user(){
        return $this->belongsTo('App\User');
    }
}
