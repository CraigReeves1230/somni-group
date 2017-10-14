@extends('layouts.frontend.main')
@section('title', 'Edit User')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ol class="breadcrumb">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('my_listings')}}">Edit Account</a></li>
                    </ol>
                    <h1 class="page-header">Edit Account</h1>
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
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li role="presentation" class="active"><a href="{{route('edit_account')}}">Update
                                Account</a></li>
                        @if(!$user->agent)
                            <li role="presentation"><a href="{{route('agent_edit')}}">Sign Up As Agent</a></li>
                        @else
                            <li role="presentation"><a href="{{route('agent_edit')}}">Edit Agent</a></li>
                        @endif
                    </ul>
                        <form data-email-address-validate="{{route('update_email_and_address_validate')}}" id="regform"
                              action="{{route('update_account')}}"
                              method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Your Name</label>
                                <input id="name" name="name" type="text" class="form-control input-lg"
                                       value="{{$user->name}}" placeholder="Your Name">
                                <div id="name-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input id="email" name="email" type="email" class="form-control input-lg"
                                       value="{{$user->email}}" placeholder="Email">
                                <div id="email-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" name="password" type="password" class="form-control input-lg"
                                       placeholder="Leave blank to keep password unchanged">
                                <div id="password-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label>Re-enter Password</label>
                                <input id="password-confirm" name="password_confirmation" type="password"
                                       class="form-control
                                input-lg" placeholder="Leave blank to keep password unchanged">
                                <div id="password-confirm-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="row">
                                    <div style="padding-right: 4px;" class="col-lg-3">
                                        <input id="area_code" name="area_code" type="text"
                                               class="form-control
                                            input-lg" value="{{$user->phone_number->area_code}}">
                                    </div>
                                    <div style="padding-left: 4px;" class="col-lg-9">
                                        <input id="phone_number" name="phone_number" type="text"
                                               class="form-control
                                            input-lg" value="{{$phone_number}}">
                                    </div>
                                </div>
                                <div id="phone-number-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input value="{{$user->dob}}" type="date" class="form-control input-lg" name="dob" id="dob">
                            </div>
                            <div class="form-group">
                                <label for="address">Address Line 1</label>
                                <input value="{{$address->line_1}}" type="text" class="form-control input-lg"
                                       name="address_line_1"
                                       id="address_line_1">
                                <div id="address_error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <div class="form-group">
                                <label for="address_line_2">Address Line 2</label>
                                <input value="{{$address->line_2}}" type="text" class="form-control input-lg"
                                       name="address_line_2"
                                       id="address_line_2">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" value="{{$address->city}}" class="form-control input-lg" name="city"
                                       id="city">
                                <div id="city_error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <label class="col-sm-4 control-label" for="state">State*</label>
                            <div class="col-sm-8">
                                <select name="state" id="state" class="form-control input-lg">
                                    <option {{$address->state == 'AL' ? "selected='selected'" : ''}}
                                            value="AL">Alabama</option>
                                    <option {{$address->state == 'AK' ? "selected='selected'" : ''}}
                                            value="AK">Alaska</option>
                                    <option {{$address->state == 'AZ' ? "selected='selected'" : ''}}
                                            value="AZ">Arizona</option>
                                    <option {{$address->state == 'AR' ? "selected='selected'" : ''}}
                                            value="AR">Arkansas</option>
                                    <option {{$address->state == 'CA' ? "selected='selected'" : ''}}
                                            value="CA">California</option>
                                    <option {{$address->state == 'CO' ? "selected='selected'" : ''}}
                                            value="CO">Colorado</option>
                                    <option {{$address->state == 'CT' ? "selected='selected'" : ''}}
                                            value="CT">Connecticut</option>
                                    <option {{$address->state == 'DE' ? "selected='selected'" : ''}}
                                            value="DE">Delaware</option>
                                    <option {{$address->state == 'DC' ? "selected='selected'" : ''}}
                                            value="DC">District Of Columbia</option>
                                    <option {{$address->state == 'FL' ? "selected='selected'" : ''}}
                                            value="FL">Florida</option>
                                    <option {{$address->state == 'GA' ? "selected='selected'" : ''}}
                                            value="GA">Georgia</option>
                                    <option {{$address->state == 'HI' ? "selected='selected'" : ''}}
                                            value="HI">Hawaii</option>
                                    <option {{$address->state == 'ID' ? "selected='selected'" : ''}}
                                            value="ID">Idaho</option>
                                    <option {{$address->state == 'IL' ? "selected='selected'" : ''}}
                                            value="IL">Illinois</option>
                                    <option {{$address->state == 'IN' ? "selected='selected'" : ''}}
                                            value="IN">Indiana</option>
                                    <option {{$address->state == 'IA' ? "selected='selected'" : ''}}
                                            value="IA">Iowa</option>
                                    <option {{$address->state == 'KS' ? "selected='selected'" : ''}}
                                            value="KS">Kansas</option>
                                    <option {{$address->state == 'KY' ? "selected='selected'" : ''}}
                                            value="KY">Kentucky</option>
                                    <option {{$address->state == 'LA' ? "selected='selected'" : ''}}
                                            value="LA">Louisiana</option>
                                    <option {{$address->state == 'ME' ? "selected='selected'" : ''}}
                                            value="ME">Maine</option>
                                    <option {{$address->state == 'MD' ? "selected='selected'" : ''}}
                                            value="MD">Maryland</option>
                                    <option {{$address->state == 'MA' ? "selected='selected'" : ''}}
                                            value="MA">Massachusetts</option>
                                    <option {{$address->state == 'MI' ? "selected='selected'" : ''}}
                                            value="MI">Michigan</option>
                                    <option {{$address->state == 'MN' ? "selected='selected'" : ''}}
                                            value="MN">Minnesota</option>
                                    <option {{$address->state == 'MS' ? "selected='selected'" : ''}}
                                            value="MS">Mississippi</option>
                                    <option {{$address->state == 'MO' ? "selected='selected'" : ''}}
                                            value="MO">Missouri</option>
                                    <option {{$address->state == 'MT' ? "selected='selected'" : ''}}
                                            value="MT">Montana</option>
                                    <option {{$address->state == 'NE' ? "selected='selected'" : ''}}
                                            value="NE">Nebraska</option>
                                    <option {{$address->state == 'NV' ? "selected='selected'" : ''}}
                                            value="NV">Nevada</option>
                                    <option {{$address->state == 'NH' ? "selected='selected'" : ''}}
                                            value="NH">New Hampshire</option>
                                    <option {{$address->state == 'NJ' ? "selected='selected'" : ''}}
                                            value="NJ">New Jersey</option>
                                    <option {{$address->state == 'NM' ? "selected='selected'" : ''}}
                                            value="NM">New Mexico</option>
                                    <option {{$address->state == 'NY' ? "selected='selected'" : ''}}
                                            value="NY">New York</option>
                                    <option {{$address->state == 'NC' ? "selected='selected'" : ''}}
                                            value="NC">North Carolina</option>
                                    <option {{$address->state == 'ND' ? "selected='selected'" : ''}}
                                            value="ND">North Dakota</option>
                                    <option {{$address->state == 'OH' ? "selected='selected'" : ''}}
                                            value="OH">Ohio</option>
                                    <option {{$address->state == 'OK' ? "selected='selected'" : ''}}
                                            value="OK">Oklahoma</option>
                                    <option {{$address->state == 'OR' ? "selected='selected'" : ''}}
                                            value="OR">Oregon</option>
                                    <option {{$address->state == 'PA' ? "selected='selected'" : ''}}
                                            value="PA">Pennsylvania</option>
                                    <option {{$address->state == 'RI' ? "selected='selected'" : ''}}
                                            value="RI">Rhode Island</option>
                                    <option {{$address->state == 'SC' ? "selected='selected'" : ''}}
                                            value="SC">South Carolina</option>
                                    <option {{$address->state == 'SD' ? "selected='selected'" : ''}}
                                            value="SD">South Dakota</option>
                                    <option {{$address->state == 'TN' ? "selected='selected'" : ''}}
                                            value="TN">Tennessee</option>
                                    <option {{$address->state == 'TX' ? "selected='selected'" : ''}}
                                            value="TX">Texas</option>
                                    <option {{$address->state == 'UT' ? "selected='selected'" : ''}}
                                            value="UT">Utah</option>
                                    <option {{$address->state == 'VT' ? "selected='selected'" : ''}}
                                            value="VT">Vermont</option>
                                    <option {{$address->state == 'VA' ? "selected='selected'" : ''}}
                                            value="VA">Virginia</option>
                                    <option {{$address->state == 'WA' ? "selected='selected'" : ''}}
                                            value="WA">Washington</option>
                                    <option {{$address->state == 'WV' ? "selected='selected'" : ''}}
                                            value="WV">West Virginia</option>
                                    <option {{$address->state == 'WI' ? "selected='selected'" : ''}}
                                            value="WI">Wisconsin</option>
                                    <option {{$address->state == 'WY' ? "selected='selected'" : ''}}
                                            value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="zip">ZIP Code</label>
                                <input value="{{$address->zip}}" type="text" class="form-control input-lg" name="zip" id="zip">
                                <div id="zip_error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                            </div>
                            <button id="submit" type="submit" class="btn btn-primary btn-lg">Update Account</button>
                        </form>
                    <div></div>
                </div>
                <!-- <div class="col-md-1">
                     <div class="sign-in-or"><img src="img/sign-in-or.png"><span>or</span></div>
                 </div>
                 <div class="col-md-4">
                     <div class="socal-login-buttons"> <a href="#" class="btn btn-social btn-lg btn-block btn-facebook"><i class="icon fa fa-facebook"></i> Sign In with Facebook</a> <a href="#" class="btn btn-social btn-lg btn-block btn-google"><i class="icon fa fa-google"></i> Sign In with Google</a> <a href="#" class="btn btn-social btn-lg btn-block btn-twitter"><i class="icon fa fa-twitter"></i> Sign In with Twitter</a> </div>
                 </div> -->
            </div>
        </div>
    </div>
    <script src="/js/edit_account.js"></script>
@endsection