@extends('layouts.frontend.main')
@section('title', 'Agent - Add Photos')
@section('content')

    <link rel="stylesheet" href="/css/frontend/dropzone.css">

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <!-- navigation -->
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li class="active"><a href="{{route('agent_add_photos')}}">Add Photos</a></li>
                        <li><a href="{{route('agent_photo_gallery')}}">Photo Gallery</a></li>
                    </ul>
                </div>
            </div>
            <!-- form to add photos -->
            <h1>Add Photos</h1>
            <hr>
            {!! Form::open(['action' => ['frontend\UsersController@save_photos'],
            'method' => 'post', 'class' => 'dropzone']) !!}

            {!! Form::close() !!}
            <br>
            <a class="btn btn-primary btn-lg" href="{{route('agent_edit')}}">Go Back</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@endsection
