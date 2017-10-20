<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['path'];

    function imageable(){
        return $this->morphTo();
    }

    //provide image with file location with accessor
    public function getPathAttribute($value){
        $new_string = env('IMAGE_FOLDER') . $value;
        return $new_string;
    }



}

