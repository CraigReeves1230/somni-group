<?php


namespace App\Services\Repositories;


use App\Contracts\iRepository;
use App\Listing;

class ListingRepository implements iRepository
{

    private $address_repository;

    function __construct(AddressRepository $address_repository){
        $this->address_repository = $address_repository;
    }

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

        // save address
        if ($address = $this->address_repository->store($data)){

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
            $listing->description = $data->description;
            $listing->address()->associate($address);
            $this->save($listing);

            return $listing;
        } else {
            return false;
        }
    }

    function update($listing, $data, $controller = null)
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

        // update address
        $address = $listing->address;
        if ($this->address_repository->update($address, $data)) {

            // reformat numbers if they are badly formatted
            $price = str_replace(',', '', $data->price);
            $area = str_replace(',', '', $data->area);

            // update listing
            $listing->title = $data->title;
            $listing->type = $data->type;
            $listing->price = $price;
            $listing->bedrooms = $data->bedrooms;
            $listing->bathrooms = $data->bathrooms;
            $listing->area = $area;
            $listing->mls = $data->mls;
            $listing->location = $data->location;
            $listing->description = $data->description;
            $this->save($listing);

            return $listing;
        } else {
            return false;
        }
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

    function delete($listing){
        $listing->delete();
    }
}