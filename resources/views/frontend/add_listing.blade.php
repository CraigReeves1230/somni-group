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
            <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="text-center">Add Listing</h1>
                <div class="lead text-center">* Indicates mandatory fields</div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form id="form" action="{{route('add_listing')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Property Title*</label>
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
                                        <option value="7+">7+</option>
                                    </select>
                                </div>
                            </div>
                            <div id="bedrooms-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Bathrooms*</label>
                                <div class="col-sm-8">
                                    <select name="bathrooms" id="bathrooms" class="form-control">
                                        <option value="" selected="selected">-- Select Bedroom --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5+">5+</option>
                                        <option value="6+">6+</option>
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
                                <label class="col-sm-4 control-label">Upload Photos</label>
                                <div class="col-sm-8">
                                    <input id="photos" name="photos" type="file" class="form-control">
                                </div>
                            </div>
                            <div id="photos-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location</label>
                                <div class="col-sm-8">
                                    <input id="location" name="location" type="text" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div id="location-error" class="error-message"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address*</label>
                                <div class="col-sm-8">
                                    <input id="address" name="address" id="address" type="text" class="form-control"
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
                                    <input id="state" name="state" type="text" class="form-control" placeholder="">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/frontend/add_listing.js"></script>
@endsection