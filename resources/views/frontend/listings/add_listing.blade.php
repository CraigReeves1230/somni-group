@extends('layouts.frontend.main')
@section('title', 'Add Listing')
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
                <h1 class="text-center">Add Listing</h1>
                <div class="lead text-center">* Indicates mandatory fields</div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form style="margin-bottom: 10px;" action="/upload-target" class="dropzone"></form>
                        <form id="form" action="{{route('add_listing')}}"
                              method="post" class="form-horizontal dropzone">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Listing Name*</label>
                                <div class="col-sm-8">
                                    <input id="title" name="title" type="text" class="form-control input-lg"
                                           placeholder="Property Title">
                                </div>
                            </div>
                            <div id="title-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">For Sale/Rent?*</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type">
                                        <option value="sale">Sale</option>
                                        <option value="rent">Rent</option>
                                    </select>
                                </div>
                            </div>
                            <div id="type-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Price (IN USD $)*</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                       id="price" name="price" placeholder="Price (IN USD $)">
                                </div>
                            </div>
                            <div id="price-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Bedrooms*</label>
                                <div class="col-sm-8">
                                    <select name="bedrooms" id="bedrooms" class="form-control">
                                        <option value="" selected="selected">-- Select Bedroom --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7+</option>
                                    </select>
                                </div>
                            </div>
                            <div id="bedrooms-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Bathrooms*</label>
                                <div class="col-sm-8">
                                    <select name="bathrooms" id="bathrooms" class="form-control">
                                        <option value="" selected="selected">-- Select Bathroom --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6+</option>
                                    </select>
                                </div>
                            </div>
                            <div id="bathrooms-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Area Sq/ft*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="area" id="area" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div id="area-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">MLS No.*</label>
                                <div class="col-sm-8">
                                    <input id="mls" name="mls" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div id="mls-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Neighborhood/Community (if
                                    applicable)</label>
                                <div class="col-sm-8">
                                    <input id="location" name="location" type="text" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div id="location-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address Line 1*</label>
                                <div class="col-sm-8">
                                    <input id="address" name="address" type="text" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address Line 2</label>
                                <div class="col-sm-8">
                                    <input id="address_line_2" name="address_line_2" type="text" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div id="address-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">City*</label>
                                <div class="col-sm-8">
                                    <input id="city" name="city" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div id="city-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">State*</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="state" name="state">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div id="state-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Zip Code*</label>
                                <div class="col-sm-8">
                                    <input id="zip" name="zip" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div id="zip-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Property Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="description" class="form-control"
                                              placeholder=""></textarea>
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
                                    <input type="submit" value="Submit Property" class="btn btn-lg btn-primary">
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
<script src="/js/frontend/add_listing.js"></script>
@endsection