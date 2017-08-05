@extends('layouts.frontend.main')
@section('title', 'Aligning vision with Reality')
@section('content')
    <link rel="stylesheet" href="/css/frontend/my_listings.css">

    <div class="id">
        <div class="container">

            <h1>My Listings</h1>
            <hr>
            <div class="agent-section list-group">
                @foreach($listings as $listing)
                    <div class="row agent-row"> <!-- start section -->
                        <div class="col-lg-3 listing-profile">

                            @if(count($listing->images) > 1)
                                @foreach($listing->images as $image)
                                    @if($image->profile)
                                        <img class="img-fluid profile"
                                             height="200" src="{{$image->path}}" alt="">
                                    @endif
                                @endforeach
                            @endif

                            @if(count($listing->images) < 2)
                                <img class="img-fluid profile" height="200" src="{{$listing->images[0]->path}}" alt="">
                            @endif

                            <div class="add-photo-link"><a
                                href="{{route('listing_upload_photos', ['id' => $listing->id])}}">Add/Edit
                                    Photos</a></div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12 property-title">
                                    <h2>{{$listing->title}}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mls-number">
                                    MLS No. {{$listing->mls}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 address-and-info">
                                    {{$listing->address->line_1}}<br>
                                    @if($listing->address->line_2 !== null)
                                        {{$listing->address->line_2}}<br>
                                    @endif
                                    {{$listing->address->city}}, {{$listing->address->state}} {{$listing->address->zip}}
                                    <div class="area-heading">Area</div>
                                    <div class="area">{{number_format($listing->area)}} sq/ft.</div>
                                    <div class="price-heading">Price</div>
                                    <div class="price">${{number_format($listing->price)}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 more-info">
                            <span class="stat-title">Type: </span><span class="stat">{{strtoupper($listing->type)
                            }}</span><br>
                            <span class="stat-title">Location: </span><span class="stat">{{$listing->location == null ?
                            'N/A' :
                            $listing->location}}</span><br>
                            <span class="stat-title">Bedrooms: </span>
                            <span class="stat">
                                @if($listing->bedrooms >= 7)
                                    7+
                                @else
                                    {{$listing->bedrooms}}
                                @endif
                            </span><br>
                            <span class="stat-title">Bathrooms:</span>
                            <span class="stat">
                                @if($listing->bathrooms >= 6)
                                    6+
                                @else
                                    {{$listing->bathrooms}}
                                @endif
                            </span><br>
                            <span class="stat-title">Status: </span>
                            @if($listing->status == 'inactive')
                                <span class="stat font-error">Inactive</span>
                            @elseif($listing->status == 'active')
                                <span class="stat font-success">Active</span>
                            @endif
                            <div class="edit-button">
                                <a href="{{route('edit_listing', ['id' => $listing->id])}}"
                                   class="btn btn-primary">Edit Listing</a>
                            </div>
                        </div>
                    </div> <!-- end section -->
                @endforeach
            </div>
        </div>
    </div>

@endsection
