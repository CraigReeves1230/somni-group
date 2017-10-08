@extends('layouts.frontend.main')
@section('title', 'Listing - Add Photos')
@section('content')

    <link rel="stylesheet" href="/css/frontend/dropzone.css">

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                <!-- navigation -->
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li class="active"><a href="{{route('listing_upload_photos', ['id' => $listing->id])}}">Add
                                Photos</a></li>
                        <li><a href="{{route('my_photos', ['id' => $listing->id])}}">Photo Gallery</a></li>
                    </ul>
                </div>
            </div>
            <!-- form to add photos -->
            <h1>Add Photos</h1>
            <hr>
            {!! Form::open(['action' => ['frontend\ListingsController@save_photos', $listing->id],
            'method' => 'post', 'class' => 'dropzone']) !!}

            {!! Form::close() !!}
            <br>
            <a class="btn btn-primary btn-lg" href="{{route('my_listings')}}">Go Back</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@endsection
