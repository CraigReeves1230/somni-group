@extends('layouts.frontend.main');
@section('title', 'Sign In');
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
                        <li role="presentation" class="active"><a href="{{route('login')}}">Sign In</a></li>
                        <li role="presentation"><a href="{{route('register_user')}}">Register</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="login">
                            <form id="form" action="{{route('login_user')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input id="email" name="email" type="email" class="form-control input-lg"
                                           placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" name="name" type="password" class="form-control input-lg"
                                           placeholder="Password">
                                </div>
                                <p class="text-right"><a href="{{route('password_reset')}}">Forgot Password</a></p>
                                <div class="checkbox">
                                    <label><input id="remember" name="remember" type="checkbox">
                                        Remember Me </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                            </form>
                            <div class="row">
                                <div id="error" class="text-center col-12 error-message">
                                    <!-- filled automatically with javascript -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div> </div>
                </div>
               <!-- <div class="col-md-1">
                    <div class="sign-in-or"><img src="img/sign-in-or.png"><span>or</span></div>
                </div> -->
               <!-- <div class="col-md-4">
                    <div class="socal-login-buttons"> <a href="#" class="btn btn-social btn-lg btn-block btn-facebook"><i class="icon fa fa-facebook"></i> Sign In with Facebook</a> <a href="#" class="btn btn-social btn-lg btn-block btn-google"><i class="icon fa fa-google"></i> Sign In with Google</a> <a href="#" class="btn btn-social btn-lg btn-block btn-twitter"><i class="icon fa fa-twitter"></i> Sign In with Twitter</a> </div>
                </div> -->
            </div>
        </div>
    </div>
    <script src="/js/bundle.js"></script>

@endsection