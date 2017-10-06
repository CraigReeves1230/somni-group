<?php

namespace App\Http\Controllers\admin;

use App\Services\Repositories\AppointmentRepository;
use App\Services\Repositories\ListingRepository;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ListingsController extends Controller
{

    private $listing_repository;

    function __construct(ListingRepository $listing_repository)
    {

        $this->listing_repository = $listing_repository;
    }

    // all listings for admin tool listings page
    function all_listings(){

        // get all listings. if none are active, make it an empty array
        if(!$listings = $this->listing_repository->all(true, 7)){
            $listings = [];
        }

        return view('admin.listings.listings', compact('listings'));
    }

    // approved listings for admin tool listings page
    function approved_listings(){

        // get all listings. if none are active, make it an empty array
        if(!$listings = $this->listing_repository->where('status', 'active')){
            $listings = [];
        }

        return view('admin.listings.listings', compact('listings'));
    }

    function pending_listings(){

        // get all listings. if none are active, make it an empty array
        if(!$listings = $this->listing_repository->where('status', 'inactive')){
            $listings = [];
        }

        return view('admin.listings.listings', compact('listings'));
    }

    function rejected_listings(){

        // get all listings. if none are active, make it an empty array
        if(!$listings = $this->listing_repository->where('status', 'rejected')){
            $listings = [];
        }

        return view('admin.listings.listings', compact('listings'));
    }

    function edit($id){
        $listing = $this->listing_repository->find($id);

        return view('admin.listings.edit', compact('listing'));
    }

    function update($id, Request $request, ListingRepository $listing_repository){
        $listing = $this->listing_repository->find($id);
        if($listing_repository->update($listing, $request, $this)){
            return redirect()->route('admin_all_listings');
        } else {
            return redirect()->back();
        }
    }

    function new_consultation($listing_id){
        $listing = $this->listing_repository->find($listing_id);
        return view('admin.consultations.new', compact('listing'));
    }

    function save_consultation(Request $request, $listing_id, AppointmentRepository $appointment_repository){
        $listing = $this->listing_repository->find($listing_id);

        if($appointment = $appointment_repository->store($request, $this)) {
            $appointment->listing()->associate($listing);
            $appointment_repository->save($appointment);

            return redirect()->route('admin_all_listings');
        } else {
            return redirect()->back();
        }
    }

    function edit_consultation($listing_id){

        $listing = $this->listing_repository->find($listing_id);
        $appointment = $listing->appointment;
        return view('admin.consultations.edit', compact('listing', 'appointment'));
    }

    function update_consultation(Request $request, $listing_id, AppointmentRepository $appointment_repository){
        $listing = $this->listing_repository->find($listing_id);
        $appointment = $listing->appointment;

        if($appointment_repository->update($appointment, $request, $this)) {
            return redirect()->route('admin_all_listings');
        } else {
            return redirect()->back();
        }
    }

    function delete_consultation($listing_id, AppointmentRepository $appointment_repository){
        try{
            // find and delete consultation
            $appointment = $appointment_repository->find_by('listing_id', $listing_id);

            $appointment_repository->delete($appointment);
            return redirect()->route('admin_all_listings');
        } catch(Exception $e){
            Session::flash('error', 'Delete failed.');
            return redirect()->route('admin_all_listings');
        }
    }

    function delete_listing($listing_id){
        try{

            // get listing and delete it
            $listing = $this->listing_repository->find($listing_id);
            $this->listing_repository->delete($listing);

            // delete listing
            $this->listing_repository->delete($listing);
            return redirect()->back();

        } catch(Exception $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

}
