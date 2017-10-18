@extends('layouts.frontend.main')
@section('title', 'Agent Photos')
@section('content')

    <div id="content">
        <div class="container">
            <link rel="stylesheet" href="/css/frontend/my_listings.css">

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <!-- navigation -->
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li><a href="{{route('agent_add_photos')}}">Add
                                Photos</a></li>
                        <li class="active"><a href="{{route('agent_photo_gallery')}}">Photo Gallery</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">

                <h1 style="margin-bottom: 20px;">Photos</h1>

                @foreach($images as $image)
                    <div class="col-lg-3">
                        <div class="card gallery-image">
                            <a data-toggle="modal" data-target="#modal-{{$image->id}}">
                                <img class="img-fluid profile" src="{{$image->path}}" alt="">
                            </a>
                            <div class="card-block">
                                <form action="{{route('agent_make_profile_pic', ['id' => $image->id])}}" method="post">
                                    {{csrf_field()}}
                                    <button type="submit" style="margin-top: 14px;" class="btn btn-block btn-primary">
                                        Make Profile Pic
                                    </button>
                                </form>
                                <form action="#" method="post">
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
            <a class="btn btn-primary btn-lg" href="{{route('agent_edit')}}">Go Back</a>
        </div>
    </div>

@endsection