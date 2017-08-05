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

    function delete($image){
        $image->delete();
    }
}