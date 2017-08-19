<?php
/**
 * Created by PhpStorm.
 * User: reeve
 * Date: 8/19/2017
 * Time: 7:27 AM
 */

namespace App\Services;


class SubscriptionService
{
    // creates a paid subscription
    function subscribe($user, $package_name, $package, $stripeToken){

        $user->newSubscription($package_name, $package)
            ->create($stripeToken);
    }
}

