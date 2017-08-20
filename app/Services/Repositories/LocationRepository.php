<?php


namespace App\Services\Repositories;


use App\Contracts\iRepository;
use App\Location;
use Exception;

class LocationRepository implements iRepository
{

    // returns the geolocater url API
    private function api_url($line_1, $postal_code){

        //get google maps API url
        $api_key = 'AIzaSyA-ZpyK3mtJuhML4IRtelZde-0f3jF8I6U';
        $raw_url = "https://maps.googleapis.com/maps/api/geocode/json?address={$line_1}, {$postal_code}&key={$api_key}";
        $url = str_replace(" ", "+", $raw_url);

        return $url;
    }

    function store($data, $controller = null)
    {
        // no need to validate...

        // get url
        $url = $this->api_url($data->line_1, $data->zip);

        // get data from url
        try
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            $response = curl_exec($ch);

            if(!empty($response)){
                $content = json_decode($response);
            } else {
                // empty message
                throw new Exception('Connection to Geolocator API returned an empty response.');
            }

            // save location
            $location = new Location([
                'latitude' => $content->results[0]->geometry->location->lat,
                'longitude' => $content->results[0]->geometry->location->lng
            ]);
            $this->save($location);

            return $location;

        } catch(Exception $e){
            // there was a problem connecting to the Google API. Return false.
            return false;
        }
    }

    function update($location, $data, $controller = null)
    {
        // no need to validate...

        // get url
        $url = $this->api_url($data->line_1, $data->zip);

        // get data from url
        try
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            $response = curl_exec($ch);

            if(!empty($response)){
                $content = json_decode($response);
            } else {
                // empty message
                throw new Exception('Connection to Geolocator API returned an empty response.');
            }

            // update location
            $location->latitude = $content->results[0]->geometry->location->lat;
            $location->longitude = $content->results[0]->geometry->location->lng;

            $this->save($location);

            return $location;

        } catch(Exception $e){
            // there was a problem connecting to the Google API. Return false.
            return false;
        }
    }

    function save($location)
    {
        $location->save();
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