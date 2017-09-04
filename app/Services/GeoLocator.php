<?php
/**
 * Created by PhpStorm.
 * User: reeve
 * Date: 8/19/2017
 * Time: 12:53 PM
 */

namespace App\Services;


use Exception;

class GeoLocator
{

    // returns the geolocater url API
    private function api_url($address){

        //get google maps API url
        $api_key = 'AIzaSyA-ZpyK3mtJuhML4IRtelZde-0f3jF8I6U';
        $raw_url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$api_key}";
        $url = str_replace(" ", "+", $raw_url);

        return $url;
    }

    // this function converts an address into a longitude and latitude point using Google API
    function convert($address){

        $url = $this->api_url($address);

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
            $location = [
                'latitude' => $content->results[0]->geometry->location->lat,
                'longitude' => $content->results[0]->geometry->location->lng
            ];

            return $location;

        } catch(Exception $e){
            // there was a problem connecting to the Google API. Return false.
            return false;
        }

    }
}