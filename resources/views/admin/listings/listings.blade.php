@extends('layouts.admin.main')
@section('content')

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <h2>Listings</h2>
            <hr>
        </div>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <nav>
                <div class="container-fluid nav-container">
                    <ul class="menu-main">
                        <li class="nav-item has-submenu"><a href="{{route('admin_all_listings')}}">All Listings</a></li>
                        <li class="nav-item has-submenu"><a href="{{route('admin_pending_listings')}}">Pending
                                Approval</a></li>
                        <li class="nav-item"><a href="{{route('admin_approved_listings')}}">Approved</a></li>
                        <li class="nav-item"><a href="{{route('admin_rejected_listings')}}">Rejected</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>



    <!-- mobile menu -->
    <div class="container-fluid mobile-nav-container px-0">
        <div class="mobile-menu">
            <!-- this is populated automatically with javascript -->
        </div>
    </div>
    <div class="mobile-handle"><i class="fa fa-bars"></i></div>

    @foreach($listings as $listing)
        <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-12 item-box">
                <div class="row"><b class="stat-title">Name:</b><b class="stat">{{$listing->title}}</b></div>
                <div class="row"><b class="stat-title">Price:</b><b class="stat">${{$listing->price}}</b></div>
                <div class="row"><b class="stat-title">Posted:</b><b
                            class="stat">{{$listing->created_at->diffForHumans()}}</b></div>
                <div class="row"><b class="stat-title">Email:</b><b
                            class="stat">{{$listing->user->email}}</b></div>
                <div class="row"><b class="stat-title">Phone:</b><b
                            class="stat">{{$listing->user->phone_number->formatted_number()}} </b></div>

                <!-- display status -->
                @if($listing->status == 'inactive')
                    <div class="row"><b class="stat-title">Status:</b><b
                                class="stat" style="color: rebeccapurple" >Pending Approval</b></div>
                @elseif($listing->status == 'active')
                    <div class="row"><b class="stat-title">Status:</b><b
                                class="stat" style="color: green" >Active</b></div>
                @elseif($listing->status == 'rejected')
                    <div class="row"><b class="stat-title">Status:</b><b
                                class="stat" style="color: darkred" >Rejected</b></div>
                @endif

                <div class="row no-gutters my-2">
                    <div class="col-3 mx-1">
                        <a href="{{route('admin_edit_listing', ['id' => $listing->id])}}" class="btn btn-success
                        btn-block">Edit</a>
                    </div>

                    @if($listing->status == 'inactive')
                        @if($listing->appointment !== null)
                            <div class="col-3 mx-1">
                                <a href="{{route('edit_consultation', ['listing_id' => $listing->id])}}" class="btn
                            btn-primary
                            btn-block">Edit
                                    Consultation</a></div>
                        @else
                            <div class="col-3 mx-1">
                                <a href="{{route('new_consultation', ['listing_id' => $listing->id])}}" class="btn
                                btn-primary
                                btn-block">Setup
                                    Consultation</a></div>
                        @endif
                    @endif

                    <div class="col-3 mx-1">
                        <form action="{{route('admin_delete_listing', ['listing_id' => $listing->id])}}" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <input class="btn btn-danger btn-block" type="submit" value="Delete" />
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

@endsection