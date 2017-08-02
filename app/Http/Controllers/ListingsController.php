<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Repositories\ListingRepository;
use Illuminate\Support\Facades\Auth;

class ListingsController extends Controller
{
    private $listing_repository;

    function __construct(ListingRepository $listing_repository){
        $this->listing_repository = $listing_repository;
    }

    function create(){
        return view('frontend.add_listing');
    }

    function store(Request $request){
        if ($listing = $this->listing_repository->store($request, $this)) {
            $user = Auth::user();
            $user->listings()->save($listing);
            if ($request->ajax()) {
                return response()->json(['ok' => true]);
            } else {
                return redirect('/');
            }
        } else {
            redirect()->back();
        }

        // handle failure to store
        if($request->ajax()){
            return response()->json(['ok' => false]);
        } else {
            return redirect()->back;
        }
    }
}
