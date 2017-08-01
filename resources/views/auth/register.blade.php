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
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <ul class="nav nav-tabs tab-lg" role="tablist">
                        <li role="presentation"><a href="{{route('login')}}">Sign In</a></li>
                        <li role="presentation" class="active"><a href="{{route('register_user')}}">Register</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="register">
                            <form data-email-validate="{{route('email_validate')}}" id="regform"
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
    <script src="/js/auth/register_form.js"></script>
@endsection
