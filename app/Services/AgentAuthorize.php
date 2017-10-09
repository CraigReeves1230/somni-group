<?php
/**
 * Created by PhpStorm.
 * User: reeve
 * Date: 10/8/2017
 * Time: 11:39 AM
 */

namespace App\Services;


class AgentAuthorize
{
    function verify($state, $license_number){

        switch($state){

            // Georgia
            case 'GA':
                $this->georgia_verify($license_number);
            break;
        }
    }

    function georgia_verify($license_number){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.example.com');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec();
        curl_close($ch);

    }

}