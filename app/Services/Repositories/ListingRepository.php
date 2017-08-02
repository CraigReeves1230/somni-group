<?php


namespace App\Services\Repositories;


use App\Contracts\iRepository;
use App\Listing;

class ListingRepository implements iRepository
{

    function store($data, $controller = null)
    {
        // validate data if call is from a controller
        if($controller != null){
            $controller->validate($data, [
                'title' => 'required|min:5|max:255',
                'price' => 'required|regex:/^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/',
                'bedrooms' => 'required',
                'bathrooms' => 'required',
                'area' => 'required|regex:/^[0-9]+$/',
                'mls' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'description' => 'max:255'
            ]);
        }

        // reformat numbers if they are badly formatted
        $price = str_replace(',', '', $data->price);
        $area = str_replace(',', '', $data->area);

        // create new listing and save
        $listing = new Listing;
        $listing->title = $data->title;
        $listing->type = $data->type;
        $listing->price = $price;
        $listing->bedrooms = $data->bedrooms;
        $listing->bathrooms = $data->bathrooms;
        $listing->area = $area;
        $listing->mls = $data->mls;
        $listing->location = $data->location;
        $listing->address = $data->address;
        $listing->city = $data->city;
        $listing->state = $data->state;
        $listing->description = $data->description;
        $listing->zip = $data->zip;
        $this->save($listing);

        return $listing;
    }

    function update($data, $controller = null)
    {
        // TODO: Implement update() method.
    }

    function save($listing)
    {
        $listing->save();
    }

    function find($id)
    {
        return Listing::find($id);
    }

    function find_by($criteria, $in_var)
    {
        return Listing::where($criteria, $in_var)->first();
    }
}