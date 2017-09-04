<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title', 'type', 'price', 'bedrooms', 'bathrooms',
        'area', 'mls', 'location', 'address', 'city', 'zip',
        'description', 'profile', 'profile_image', 'profile_image_id'
    ];

    // gets the user for a listing
    function user(){
        return $this->belongsTo('App\User');
    }

    // get images
    function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    // get profile image by id
    function getProfileImageById(){
        return Image::find($this->profile_image_id);
    }

    // get address
    function address(){
        return $this->belongsTo('App\Address');
    }

}
