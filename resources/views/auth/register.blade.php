@extends('layouts.frontend.main');
@section('title', 'Register');
@section('content')

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Login</a></li>
                    </ol>
                    <h1 class="page-header">Please sign in or register</h1>
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
                        <li role="presentation"><a href="{{route('login')}}">Sign In</a></li>
                        <li role="presentation" class="active"><a href="{{route('register_user')}}">Register</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="register">
                            <form data-email-address-validate="{{route('email_and_address_validate')}}" id="regform"
                                  action="{{route('register_user')}}"
                                  method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input id="name" name="name" type="text" class="form-control input-lg"
                                           placeholder="Your Name">
                                    <div id="name-error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input id="email" name="email" type="email" class="form-control input-lg"
                                           placeholder="Email">
                                    <div id="email-error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" name="password" type="password" class="form-control input-lg"
                                           placeholder="Password">
                                    <div id="password-error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label>Re-enter Password</label>
                                    <input id="password-confirm" name="password_confirmation" type="password"
                                           class="form-control
                                    input-lg" placeholder="Re-enter Password">
                                    <div id="password-confirm-error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div style="padding-right: 4px;" class="col-lg-3">
                                            <input id="area-code" name="area_code" type="text"
                                                   class="form-control
                                            input-lg">
                                        </div>
                                        <div style="padding-left: 4px;" class="col-lg-9">
                                            <input id="phone-number" name="phone_number" type="text"
                                                   class="form-control input-lg">
                                        </div>
                                    </div>
                                    <div id="phone-number-error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control input-lg" name="dob" id="dob">
                                </div>
                                <div class="form-group">
                                    <label for="address_line_1">Address Line 1</label>
                                    <input type="text" class="form-control input-lg" name="address_line_1" id="address_line_1">
                                    <div id="address_error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label for="address_line_2">Address Line 2</label>
                                    <input type="text" class="form-control input-lg" name="address_line_2" id="address_line_2">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control input-lg" name="city" id="city">
                                    <div id="city_error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control input-lg" id="state" name="state">
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
                                <div class="form-group">
                                    <label for="zip">ZIP Code</label>
                                    <input type="text" class="form-control input-lg" name="zip" id="zip">
                                    <div id="zip_error"
                                         class="error-message"><!-- filled by javascript automatically --></div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="checkbox" name="checkbox" type="checkbox">
                                        By registering I accept our Terms of Use and Privacy. </label>
                                </div>
                                <div id="checkbox-error"
                                     class="error-message"><!-- filled by javascript automatically --></div>
                                <button id="submit" type="submit" class="btn btn-primary btn-lg">Register</button>
                            </form>
                        </div>
                    </div>
                    <div> </div>
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
   <script src="/js/bundle.js"></script>
@endsection
