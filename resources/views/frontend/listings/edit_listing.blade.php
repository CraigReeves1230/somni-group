@extends('layouts.frontend.main')
@section('title', 'Edit Listing')
@section('content')
    <div id="content">
        <div class="container">
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
            @if(Session::has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1 class="text-center">Edit Listing</h1>
                    <div class="lead text-center">* Indicates mandatory fields</div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form style="margin-bottom: 10px;" action="/upload-target" class="dropzone"></form>
                            <form id="form" action="{{route('edit_listing_go', ['id' => $listing->id])}}"
                                  method="post" class="form-horizontal dropzone">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Listing Name*</label>
                                    <div class="col-sm-8">
                                        <input id="title" name="title" type="text" class="form-control input-lg"
                                              value="{{$listing->title}}" placeholder="Property Title">
                                    </div>
                                </div>
                                <div id="title-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">For Sale/Rent?*</label>
                                    <div class="col-sm-8">
                                        <select name="type" id="type">
                                            @if($listing->type == 'sale')
                                                <option selected="selected" value="sale">Sale</option>
                                                <option value="rent">Rent</option>
                                            @else
                                                <option value="sale">Sale</option>
                                                <option selected="selected" value="rent">Rent</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div id="type-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Price (IN USD $)*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$listing->price}}"
                                               id="price" name="price" placeholder="Price (IN USD $)">
                                    </div>
                                </div>
                                <div id="price-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Bedrooms*</label>
                                    <div class="col-sm-8">
                                        <select name="bedrooms" id="bedrooms"
                                                class="form-control">
                                            <option value="">-- Select Bedroom --</option>
                                            <option {{$listing->bedrooms == 0 ? "selected='selected'" : ''}}
                                                    value="0">0</option>
                                            <option {{$listing->bedrooms == 1 ? "selected='selected'" : ''}}
                                                    value="1">1</option>
                                            <option {{$listing->bedrooms == 2 ? "selected='selected'" : ''}}
                                                    value="2">2</option>
                                            <option {{$listing->bedrooms == 3 ? "selected='selected'" : ''}}
                                                    value="3">3</option>
                                            <option {{$listing->bedrooms == 4 ? "selected='selected'" : ''}}
                                                    value="4">4</option>
                                            <option {{$listing->bedrooms == 5 ? "selected='selected'" : ''}}
                                                    value="5">5</option>
                                            <option {{$listing->bedrooms == 6 ? "selected='selected'" : ''}}
                                                    value="6">6</option>
                                            <option {{$listing->bedrooms == 7 ? "selected='selected'" : ''}}
                                                    value="7">7+</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="bedrooms-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Bathrooms*</label>
                                    <div class="col-sm-8">
                                        <select name="bathrooms" id="bathrooms" class="form-control">
                                            <option value="">-- Select Bathroom --</option>
                                            <option {{$listing->bathrooms == 0 ? "selected='selected'" : ''}}
                                                    value="0">0</option>
                                            <option {{$listing->bathrooms == 1 ? "selected='selected'" : ''}}
                                                    value="1">1</option>
                                            <option {{$listing->bathrooms == 2 ? "selected='selected'" : ''}}
                                                    value="2">2</option>
                                            <option {{$listing->bathrooms == 3 ? "selected='selected'" : ''}}
                                                    value="3">3</option>
                                            <option {{$listing->bathrooms == 4 ? "selected='selected'" : ''}}
                                                    value="4">4</option>
                                            <option {{$listing->bathrooms == 5 ? "selected='selected'" : ''}}
                                                    value="5">5</option>
                                            <option {{$listing->bathrooms == 6 ? "selected='selected'" : ''}}
                                                    value="6">6+</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="bathrooms-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Area Sq/ft*</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="area" id="area" value="{{$listing->area}}"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div id="area-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">MLS No. (if available)</label>
                                    <div class="col-sm-8">
                                        <input id="mls" name="mls" type="text" class="form-control"
                                              value="{{$listing->mls}}" placeholder="">
                                    </div>
                                </div>
                                <div id="mls-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Neighborhood/Community (if
                                        applicable)</label>
                                    <div class="col-sm-8">
                                        <input id="location" name="location" type="text" class="form-control"
                                              value="{{$listing->location}}" placeholder="">
                                    </div>
                                </div>
                                <div id="location-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Year Built</label>
                                    <div class="col-sm-8">
                                        <input id="year_built" name="year_built" type="text" class="form-control"
                                               placeholder="" value="{{$listing->year_built}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address Line 1*</label>
                                    <div class="col-sm-8">
                                        <input id="address" name="address_line_1" type="text"
                                               class="form-control"
                                              value="{{$listing->address->line_1}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address Line 2</label>
                                    <div class="col-sm-8">
                                        <input id="address_line_2" name="address_line_2" type="text" class="form-control"
                                               value="{{$listing->address->line_2}}"  placeholder="">
                                    </div>
                                </div>
                                <div id="address-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">City*</label>
                                    <div class="col-sm-8">
                                        <input id="city" name="city" type="text"
                                              value="{{$listing->address->city}}" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div id="city-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="state">State*</label>
                                    <div class="col-sm-8">
                                        <select name="state" id="state" class="form-control">
                                            <option {{$listing->address->state == 'GA' ? "selected='selected'" : ''}}
                                                    value="GA">Georgia</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="state-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Zip Code*</label>
                                    <div class="col-sm-8">
                                        <input id="zip" name="zip" type="text" value="{{$listing->address->zip}}"
                                               class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div id="zip-error" class="error-message"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Property Description</label>
                                    <div class="col-sm-8">
                                    <textarea name="description" id="description" class="form-control"
                                              placeholder="">{{$listing->description}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                     <div class="col-sm-offset-4 col-sm-8">
                                         <div class="checkbox">
                                             <label>
                                                 <input id="feature" name="feature" type="checkbox">
                                                 Yes ‚ feature this listing. </label>
                                         </div>
                                     </div>
                                 </div> -->
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="submit" value="Save Changes" class="btn btn-lg btn-primary">
                                    </div>
                                </div>
                                <div id="geolocator-error" class="error-message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/bundle.js"></script>
@endsection