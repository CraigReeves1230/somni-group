<?php

namespace App\Services\Repositories;


use App\Address;
use App\Contracts\iRepository;

class AddressRepository implements iRepository
{
    private $location_repository;

    function __construct(LocationRepository $location_repository){
        $this->location_repository = $location_repository;
    }

    function store($data, $controller = null)
    {
        // no need for validation...

        // create new address
        $address = new Address([
            'line_1' => $data->address,
            'line_2' => $data->address_line_2,
            'city' => $data->city,
            'state' => $data->state,
            'zip' => $data->zip
        ]);

        if($location = $this->location_repository->store($data)) {
            $this->save($address);
            $location->address()->associate($address);
            $this->location_repository->save($location);
            return $address;
        } else {
            return false;
        }
    }

    function update($address, $data, $controller = null)
    {
        // no need for validation

        // update location
        $location = $address->location;
        if($this->location_repository->update($location, $data)){

        // update address

            $address->line_1 = $data->address;
            $address->line_2 = $data->address_line_2;
            $address->city = $data->city;
            $address->state = $data->state;
            $address->zip = $data->zip;

            // save data
            $this->save($address);
            return $address;
        } else {
            return false;
        }
    }

    function save($address)
    {
        $address->save();
    }

    function find($id)
    {
        // TODO: Implement find() method.
    }

    function find_by($criteria, $in_var)
    {
        // TODO: Implement find_by() method.
    }

    function delete($deleteable)
    {
        // TODO: Implement delete() method.
    }
}