@extends('layouts.admin.main')
@section('content')

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <h2>Setup Consultation</h2>
            <hr>
        </div>
    </div>

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
        </div>
    </div>

    <!-- Display errors -->
    @if(count($errors) > 0)
        <div class="alert alert-danger" style="margin-top: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="my-4">
        <form method="POST" action="{{route('save_consultation', ['listing_id' => $listing->id])}}">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="date">Date</label>
                    <input name="date" id="date" type="date" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="date">Time</label>
                    <input name="time" id="time" type="time" class="form-control">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="Save Consultation">

        </form>
    </div>

@endsection
    
    
