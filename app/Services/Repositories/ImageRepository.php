<?php


namespace App\Services\Repositories;


use App\Contracts\iRepository;
use App\Image;

class ImageRepository implements iRepository
{

    function store($data, $controller = null)
    {
        $file = $data->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move("img", $name);
        $image = new Image(['path' => $name]);

        return $image;
    }

    function update($image, $data, $controller = null)
    {
        // TODO: Implement update() method.
    }

    function save($image)
    {
        $image->save();
    }

    function find($id)
    {
        return Image::find($id);
    }

    function find_by($criteria, $in_var)
    {
        return Image::where($criteria, $in_var)->first();
    }

    function where($criteria, $in_var, $paginate = true, $per_page = 10){
        if($paginate){
            $ret_val = Image::where($criteria, $in_var)->paginate($per_page);
        } else {
            $ret_val = Image::where($criteria, $in_var)->get();
        }

        return $ret_val;
    }

    function delete($image){
        // remove source image
        if($image->getOriginal('path') !== 'generichouse.png'){
            unlink("../public{$image->path}");
        }
        $image->delete();
    }
}