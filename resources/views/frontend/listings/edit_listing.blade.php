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
                                    <label class="col-sm-4 control-label">Address Line 1*</label>
                                    <div class="col-sm-8">
                                        <input id="address" name="address" id="address" type="text" class="form-control"
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
                                            <option {{$listing->address->state == 'AL' ? "selected='selected'" : ''}}
                                                    value="AL">Alabama</option>
                                            <option {{$listing->address->state == 'AK' ? "selected='selected'" : ''}}
                                                    value="AK">Alaska</option>
                                            <option {{$listing->address->state == 'AZ' ? "selected='selected'" : ''}}
                                                    value="AZ">Arizona</option>
                                            <option {{$listing->address->state == 'AR' ? "selected='selected'" : ''}}
                                                    value="AR">Arkansas</option>
                                            <option {{$listing->address->state == 'CA' ? "selected='selected'" : ''}}
                                                    value="CA">California</option>
                                            <option {{$listing->address->state == 'CO' ? "selected='selected'" : ''}}
                                                    value="CO">Colorado</option>
                                            <option {{$listing->address->state == 'CT' ? "selected='selected'" : ''}}
                                                    value="CT">Connecticut</option>
                                            <option {{$listing->address->state == 'DE' ? "selected='selected'" : ''}}
                                                    value="DE">Delaware</option>
                                            <option {{$listing->address->state == 'DC' ? "selected='selected'" : ''}}
                                                    value="DC">District Of Columbia</option>
                                            <option {{$listing->address->state == 'FL' ? "selected='selected'" : ''}}
                                                    value="FL">Florida</option>
                                            <option {{$listing->address->state == 'GA' ? "selected='selected'" : ''}}
                                                    value="GA">Georgia</option>
                                            <option {{$listing->address->state == 'HI' ? "selected='selected'" : ''}}
                                                    value="HI">Hawaii</option>
                                            <option {{$listing->address->state == 'ID' ? "selected='selected'" : ''}}
                                                    value="ID">Idaho</option>
                                            <option {{$listing->address->state == 'IL' ? "selected='selected'" : ''}}
                                                    value="IL">Illinois</option>
                                            <option {{$listing->address->state == 'IN' ? "selected='selected'" : ''}}
                                                    value="IN">Indiana</option>
                                            <option {{$listing->address->state == 'IA' ? "selected='selected'" : ''}}
                                                    value="IA">Iowa</option>
                                            <option {{$listing->address->state == 'KS' ? "selected='selected'" : ''}}
                                                    value="KS">Kansas</option>
                                            <option {{$listing->address->state == 'KY' ? "selected='selected'" : ''}}
                                                    value="KY">Kentucky</option>
                                            <option {{$listing->address->state == 'LA' ? "selected='selected'" : ''}}
                                                    value="LA">Louisiana</option>
                                            <option {{$listing->address->state == 'ME' ? "selected='selected'" : ''}}
                                                    value="ME">Maine</option>
                                            <option {{$listing->address->state == 'MD' ? "selected='selected'" : ''}}
                                                    value="MD">Maryland</option>
                                            <option {{$listing->address->state == 'MA' ? "selected='selected'" : ''}}
                                                    value="MA">Massachusetts</option>
                                            <option {{$listing->address->state == 'MI' ? "selected='selected'" : ''}}
                                                    value="MI">Michigan</option>
                                            <option {{$listing->address->state == 'MN' ? "selected='selected'" : ''}}
                                                    value="MN">Minnesota</option>
                                            <option {{$listing->address->state == 'MS' ? "selected='selected'" : ''}}
                                                    value="MS">Mississippi</option>
                                            <option {{$listing->address->state == 'MO' ? "selected='selected'" : ''}}
                                                    value="MO">Missouri</option>
                                            <option {{$listing->address->state == 'MT' ? "selected='selected'" : ''}}
                                                    value="MT">Montana</option>
                                            <option {{$listing->address->state == 'NE' ? "selected='selected'" : ''}}
                                                    value="NE">Nebraska</option>
                                            <option {{$listing->address->state == 'NV' ? "selected='selected'" : ''}}
                                                    value="NV">Nevada</option>
                                            <option {{$listing->address->state == 'NH' ? "selected='selected'" : ''}}
                                                    value="NH">New Hampshire</option>
                                            <option {{$listing->address->state == 'NJ' ? "selected='selected'" : ''}}
                                                    value="NJ">New Jersey</option>
                                            <option {{$listing->address->state == 'NM' ? "selected='selected'" : ''}}
                                                    value="NM">New Mexico</option>
                                            <option {{$listing->address->state == 'NY' ? "selected='selected'" : ''}}
                                                    value="NY">New York</option>
                                            <option {{$listing->address->state == 'NC' ? "selected='selected'" : ''}}
                                                    value="NC">North Carolina</option>
                                            <option {{$listing->address->state == 'ND' ? "selected='selected'" : ''}}
                                                    value="ND">North Dakota</option>
                                            <option {{$listing->address->state == 'OH' ? "selected='selected'" : ''}}
                                                    value="OH">Ohio</option>
                                            <option {{$listing->address->state == 'OK' ? "selected='selected'" : ''}}
                                                    value="OK">Oklahoma</option>
                                            <option {{$listing->address->state == 'OR' ? "selected='selected'" : ''}}
                                                    value="OR">Oregon</option>
                                            <option {{$listing->address->state == 'PA' ? "selected='selected'" : ''}}
                                                    value="PA">Pennsylvania</option>
                                            <option {{$listing->address->state == 'RI' ? "selected='selected'" : ''}}
                                                    value="RI">Rhode Island</option>
                                            <option {{$listing->address->state == 'SC' ? "selected='selected'" : ''}}
                                                    value="SC">South Carolina</option>
                                            <option {{$listing->address->state == 'SD' ? "selected='selected'" : ''}}
                                                    value="SD">South Dakota</option>
                                            <option {{$listing->address->state == 'TN' ? "selected='selected'" : ''}}
                                                    value="TN">Tennessee</option>
                                            <option {{$listing->address->state == 'TX' ? "selected='selected'" : ''}}
                                                    value="TX">Texas</option>
                                            <option {{$listing->address->state == 'UT' ? "selected='selected'" : ''}}
                                                    value="UT">Utah</option>
                                            <option {{$listing->address->state == 'VT' ? "selected='selected'" : ''}}
                                                    value="VT">Vermont</option>
                                            <option {{$listing->address->state == 'VA' ? "selected='selected'" : ''}}
                                                    value="VA">Virginia</option>
                                            <option {{$listing->address->state == 'WA' ? "selected='selected'" : ''}}
                                                    value="WA">Washington</option>
                                            <option {{$listing->address->state == 'WV' ? "selected='selected'" : ''}}
                                                    value="WV">West Virginia</option>
                                            <option {{$listing->address->state == 'WI' ? "selected='selected'" : ''}}
                                                    value="WI">Wisconsin</option>
                                            <option {{$listing->address->state == 'WY' ? "selected='selected'" : ''}}
                                                    value="WY">Wyoming</option>
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