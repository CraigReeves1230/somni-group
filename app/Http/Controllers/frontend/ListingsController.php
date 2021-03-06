<?php

namespace App\Http\Controllers\frontend;

use App\Image;
use App\Services\Gateways\ListingGateway;
use App\Services\GeoLocator;
use App\Services\Repositories\AddressRepository;
use App\Services\Repositories\ImageRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Services\Repositories\ListingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{
    private $listing_gateway;
    private $user_repository;
    private $address_repository;
    private $solr_client;
    private $listing_repository;
    private $image_repository;


    function __construct(ListingRepository $listing_repository,
                         ListingGateway $listing_gateway, ImageRepository $image_repository,
                         UserRepository $user_repository, AddressRepository $address_repository){
        $this->listing_repository = $listing_repository;
        $this->listing_gateway = $listing_gateway;
        $this->user_repository = $user_repository;
        $this->address_repository = $address_repository;
        $this->solr_client = app('solr_listings');
        $this->image_repository;
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
            $this->make_profile($listing->id, $image->id, $image_repository);

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
            $this->handle_profile_pic($listing);

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
            $this->handle_profile_pic($listing);

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

            // make selected image the profile
            $listing->profile_image = $orig_image->getOriginal('path');
            $listing->profile_image_id = $orig_image->id;
            $this->listing_repository->save($listing);

            return redirect()->route('my_listings');
        } else {
            Session::flash('error', 'You do not have permission to change this listing.');
            return redirect('/');
        }
    }

    private function handle_profile_pic($listing){

        // determine how many images listing has
        $image_amount = (count($listing->images) - 1);

        // if there is only one image, make it the profile pic
        if($image_amount === 1){
            $listing->profile_image = $listing->images[1]->getOriginal('path');
            $listing->profile_image_id = $listing->images[1]->id;
        }

        // if there are no images, make the generic image the profile pic
        if($image_amount === 0){
            $listing->profile_image = $listing->images[0]->getOriginal('path');
            $listing->profile_image_id = $listing->images[0]->id;
        }

        // if the profile image no longer exists, make the first image the profile pic
        if(!$listing->profile_image_object){
            $listing->profile_image = $listing->images[1]->getOriginal('path');
            $listing->profile_image_id = $listing->images[1]->id;
        }

        // if no profile pic has been assigned and there is more than one image, make it the first one
        if($image_amount > 0 && $listing->profile_image === $listing->images[0]->getOriginal('path')){
            $listing->profile_image = $listing->images[1]->getOriginal('path');
            $listing->profile_image_id = $listing->images[1]->id;
        }

        $this->listing_repository->save($listing);
    }

    function getAllDataFromListingResults(Request $request){
        if($request->ajax()){
            $listings = $request->listings;
            $users = [];
            $addresses = [];
            $created_ats = [];
            $phone_numbers = [];
            $coords = [];
            $user_avatars = [];
            foreach($listings as $listing){
                $created_at = $this->listing_repository->find($listing['id'])->created_at->diffForHumans();
                $user = $this->user_repository->find($listing['user_id']);
                $address = $this->address_repository->find($listing['address_id']);
                $phone = $user->phone_number;
                $phone_number = "({$phone->area_code}) " . substr_replace($phone->number, '-', 3, 0);
                $point = $address->location;
                $user_avatar = $user->profile_image_path();
                array_push($addresses, $address);
                array_push($users, $user);
                array_push($created_ats, $created_at);
                array_push($phone_numbers, $phone_number);
                array_push($coords, $point);
                array_push($user_avatars, $user_avatar);
            }
            return response()->json([
                'addresses' => $addresses,
                'users' => $users,
                'created_ats' => $created_ats,
                'phone_numbers' => $phone_numbers,
                'coords' => $coords,
                'user_avatars' => $user_avatars
            ]);
        }
    }

    function search(Request $request){

        // create the search query by removing spaces and punctuation
        $search_query = str_replace(" ", "+", $request->search_field);
        $search_query = str_replace(",", "", $search_query);

        // don't allow user to not put something in
        if($search_query == ""){
            return redirect()->back();
        }

        $search_type = $request->search_type;

        if($request->ajax()){
            return response()->json(['search_results_link' => route('search_results', ['search_query' =>
                $search_query, 'search_type' => $search_type]), 'search_type' => $search_type]);
        } else {
            return redirect()->route('search_results', ['search_query' => $search_query,
                'search_type' => $search_type]);
        }
    }

    function search_results($search_query, $search_type, GeoLocator $geo_locator){

        // format search query
        $search_query = str_replace("+", " ", $search_query);

        // set up query
        $location = $geo_locator->convert($search_query);
        $client = $this->solr_client;
        $query = $client->createSelect();
        $helper = $query->getHelper();

        $latitude = $location['latitude'];
        $longitude = $location['longitude'];
        $distance = 50;  // search within 50 miles

        $statement = "type:{$search_type}";

        // set query and get search results
        $query->createFilterQuery('type')->setQuery($statement);

        // if the asterisk is used, it will return all listings, if address entered, filter by location
        if($search_query !== '*') {
            $query->createFilterQuery('distance')->setQuery(
                $helper->geofilt(
                    'latlon',
                    doubleval($latitude),
                    doubleval($longitude),
                    doubleval($distance * 1.609344))
            );
        }

        // store query in resultset
        $resultset = $client->select($query);

        // store all search results in array
        $listings_array = [];
        foreach($resultset as $result){
            $listing = $this->listing_repository->find($result->id);
            array_push($listings_array, $listing);
        }
        $listings = $listings_array;

        return view('frontend.listings.search_results', compact('search_query', 'listings', 'search_type'));
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

    // for sale link
    function all_listings($search_type){

        // get the current user if one is logged in
        $user = !Auth::guest() ? Auth::user() : null;

        // if there is a logged in user, get their address if one exists
        $address = ($user !== null && $user->address !== null) ?
            "{$user->address->line_1} {$user->address->city} {$user->address->zip}" : null;

        // if there is an address present, search by address
        if($address !== null){
            return redirect()->route('search_results', ['search_query' => $address, 'search_type' => $search_type]);
        } else {
            // if there isn't an address present, all listings will show up
            return redirect()->route('search_results', ['search_query' => '*', 'search_type' => $search_type]);
        }

    }

}
