<?php

namespace App\Http\Controllers;

use App\Image;
use App\Services\Gateways\ListingGateway;
use App\Services\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Services\Repositories\ListingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ListingsController extends Controller
{
    private $listing_repository;
    private $listing_gateway;
    private $solr_client;

    function __construct(ListingRepository $listing_repository, ListingGateway $listing_gateway){
        $this->listing_repository = $listing_repository;
        $this->listing_gateway = $listing_gateway;
        $this->solr_client = app('solr_listings');
    }

    function create(){
        return view('frontend.listings.add_listing');
    }

    function store(Request $request, ImageRepository $image_repository){
        if ($listing = $this->listing_repository->store($request, $this)) {
            $user = Auth::user();
            $user->listings()->save($listing);

            // create generic profile for listing
            $image = new Image(['path' => 'generichouse.png']);
            $listing->images()->save($image);

            if ($request->ajax()) {
                return response()->json(['ok' => true]);
            } else {
                return redirect('/listings/my_listings');
            }
        }

        // handle failure to store
        if($request->ajax()){
            return response()->json(['ok' => false, 'msg' => 'The address entered does not match postal records']);
        } else {
            Session::flash('error', 'The address entered does not match postal records.');
            return redirect()->back;
        }
    }

    function my_listings(){
        $listings = Auth::user()->listings()->paginate(10);
        return view('frontend.listings.my_listings', compact('listings'));
    }

    function edit($id){

        // get the user
        $user = Auth::user();

        // get the listing
        $listing = $this->listing_repository->find($id);

        // go to edit screen
        if($this->listing_gateway->enact($user, $listing)){
            return view('frontend.listings.edit_listing', compact('user', 'listing'));
        } else {
            Session::flash('danger', 'You do not have permission to edit this listing.');
            return redirect('/');
        }
    }

    function update(Request $request, $id){

        // get the user
        $user = Auth::user();

        // get the listing
        $listing = $this->listing_repository->find($id);

        // update the listing
        if ($this->listing_gateway->enact($user, $listing)){

            // update listing
            if ($listing = $this->listing_repository->update($listing, $request, $this)){

                // return
                if($request->ajax()){
                    return response()->json(['ok' => true]);
                } else {
                    return redirect('/listings/my_listings');
                }
            } else {
                if($request->ajax()) {
                    return response()->json(['ok' => false, 'msg' => 'The address entered does not match postal records.']);
                } else {
                    Session::flash('error', 'The address entered does not match postal records.');
                    return redirect()->back();
                }
            }
        } else {
            Session::flash('error', 'You do not have permission to edit this listing.');
            return redirect('/');
        }
    }

    function add_photos($id){

        // get listing
        $listing = $this->listing_repository->find($id);

        // get user
        $user = Auth::user();

        if($this->listing_gateway->enact($user, $listing)) {
            return view('frontend.listings.add_photos', compact('listing'));
        } else {
            Session::flash('danger', 'You do not have permission to add photos to this listing.');
            return redirect('/');
        }
    }

    function save_photos(Request $request, $id, ImageRepository $image_repository){

        // get the listing
        $listing = $this->listing_repository->find($id);

        // get the user
        $user = Auth::user();

        if($this->listing_gateway->enact($user, $listing)){

            // save image
            $image = $image_repository->store($request, $this);
            $listing->images()->save($image);

            // if there aren't any other images, by default, make it the profile
            if(count($listing->images) < 3){
                $image->profile = true;
                $image_repository->save($image);
            }

        } else {
            return false;
        }
    }

    function my_photos($id){
        $listing = $this->listing_repository->find($id);
        $user = Auth::user();

        if($this->listing_gateway->enact($user, $listing)){
            $images = $listing->images()->skip(1)->take(1000000000000)->get();
            return view('frontend.listings.photo_gallery', compact('listing', 'images'));
        }
    }

    function delete_photo($listing_id, $image_id, ImageRepository $image_repository){
        $user = Auth::user();
        $listing = $this->listing_repository->find($listing_id);
        $image = $image_repository->find($image_id);

        if($this->listing_gateway->enact($user, $listing)){
            $image_repository->delete($image);

            return redirect()->back();
        } else {
            Session::flash('danger', 'You do not have permission to delete photo.');
            return redirect('/');
        }
    }

    function make_profile($listing_id, $image_id, ImageRepository $image_repository){
        $user = Auth::user();
        $listing = $this->listing_repository->find($listing_id);
        $orig_image = $image_repository->find($image_id);

        if($this->listing_gateway->enact($user, $listing)){

            // falsify all other images
            foreach($listing->images as $image){
                $image->profile = false;
                $image_repository->save($image);
            }

            // make selected image the profile
            $orig_image->profile = true;
            $image_repository->save($orig_image);

            return redirect()->route('my_listings');
        } else {
            Session::flash('error', 'You do not have permission to change this listing.');
            return redirect('/');
        }
    }

    function search(Request $request){

        // create the search query by removing spaces and punctuation
        $search_query = str_replace(" ", "+", $request->search_field);
        $search_query = str_replace(",", "", $search_query);

        $search_type = $request->search_type;

        return redirect()->route('search_results', ['search_query' => $search_query, 'search_type' => $search_type]);
    }

    function search_results($search_query, $search_type){

        // format search query
        $search_query = str_replace("+", " ", $search_query);

        // set up query
        $client = $this->solr_client;
        $query = $client->createSelect();

        $statement = "address:{$search_query} AND type:{$search_type} 
        OR location:{$search_query} OR city:{$search_query}
        OR zip:{$search_query} OR title:{$search_query}";

        // set query and get search results
        $query->createFilterQuery('type')->setQuery($statement);
        $resultset = $client->select($query);

        // store all search results in array
        $listings = [];
        foreach($resultset as $result){
            $listing = $this->listing_repository->find($result->id);
            array_push($listings, $listing);
        }

        return view('frontend.listings.search_results', compact('search_query', 'listings'));
    }

    function delete_listing($id){
        $listing = $this->listing_repository->find($id);

        if($this->listing_gateway->enact(Auth::user(), $listing)){
            // delete listing
            $this->listing_repository->delete($listing);
            return redirect()->back();
        } else {
            Session::flash('error', 'You do not have permission to delete this listing.');
            return redirect()->back();
        }
    }
}
