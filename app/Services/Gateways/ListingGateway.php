<?php


namespace App\Services\Gateways;


class ListingGateway
{
    function enact($user, $listing){

        if($user == null){
            return false;
        }

        if($user->id !== $listing->user->id){
            return false;
        }

        // otherwise, return true
        return true;
    }
}