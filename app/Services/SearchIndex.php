<?php
/**
 * Created by PhpStorm.
 * User: reeve
 * Date: 8/12/2017
 * Time: 1:46 AM
 */

namespace App\Services;


class SearchIndex
{
    private $solr_listings;

    function __construct(){
        $this->solr_listings = app('solr_listings');
    }

    function add_listing($listing){
        $update = $this->solr_listings->createUpdate();
        $doc = $update->createDocument();
        $doc->id = $listing->id;
        $doc->type = $listing->type;
        $doc->latlon = doubleval($listing->address->location->latitude) . "," . doubleval($listing->address->location->longitude);
        $update->addDocuments([$doc]);
        $update->addCommit();
        $this->solr_listings->update($update);
    }

    function update_listing($listing){
        $this->add_listing($listing);
    }

    function remove_listing($listing){
        // delete
        $update = $this->solr_listings->createUpdate();
        $update->addDeleteById($listing->id);
        $update->addCommit();
        $result = $this->solr_listings->update($update);
    }
}