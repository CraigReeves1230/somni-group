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
    private $solr_agents;

    function __construct(){
        $this->solr_listings = app('solr_listings');
        $this->solr_agents = app('solr_agents');
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

    function add_agent($agent){
        $update = $this->solr_agents->createUpdate();
        $doc = $update->createDocument();
        $doc->id = $agent->id;
        $doc->name = $agent->name;
        $doc->address_line_1 = $agent->address->line_1;
        $doc->address_line_2 = $agent->address->line_2;
        $doc->city = $agent->address->city;
        $doc->state = $agent->address->state;
        $doc->zip = $agent->address->zip;
        $doc->phone_number = $agent->phone_number->formatted_number();
        $doc->license_number = $agent->license_number;
        $doc->agent_type = $agent->agent_type;
        $doc->latlon = doubleval($agent->address->location->latitude) . "," . doubleval
            ($agent->address->location->longitude);
        $update->addDocuments([$doc]);
        $update->addCommit();
        $this->solr_agents->update($update);
    }

    function update_agent($agent){
        $this->add_agent($agent);
    }

    function remove_agent($agent){
        $update = $this->solr_listings->createUpdate();
        $update->addDeleteById($agent->id);
        $update->addCommit();
        $result = $this->solr_agents->update($update);
    }
}