@extends('layouts.frontend.main')
@section('title', 'My Listing Photos')
@section('content')

    <div id="content">
        <div class="container">
            <link rel="stylesheet" href="/css/frontend/my_listings.css">

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <!-- navigation -->
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li><a href="{{route('listing_upload_photos', ['id' => $listing->id])}}">Add
                                Photos</a></li>
                        <li class="active"><a href="{{route('my_photos', ['id' => $listing->id])}}">Photo Gallery</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">

            <h1 style="margin-bottom: 20px;">Photos</h1>

            @foreach($images as $image)
                <div class="col-lg-3">
                    <div class="card gallery-image">
                        <a data-toggle="modal" data-target="#modal-{{$image->id}}">
                            <img class="img-fluid profile" src="/img/{{$image->path}}" alt="">
                        </a>
                        <div class="card-block">
                            <form action="{{route('make_profile', ['listing_id' => $listing->id, 'image_id' =>
                            $image->id])}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" style="margin-top: 14px;" class="btn btn-block btn-primary">
                                    Make Profile Pic
                                </button>
                            </form>
                            <form action="{{route('delete_listing_photo', ['listing_id' => $listing->id, 'image_id' => $image->id])}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" style="margin-top: 14px;"
                                        class="btn btn-block btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div id="modal-{{$image->id}}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-body align_image">
                                <img class="img-fluid" src="{{$image->path}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <a class="btn btn-primary btn-lg" href="{{route('my_listings')}}">Go Back</a>
        </div>
    </div>

@endsection