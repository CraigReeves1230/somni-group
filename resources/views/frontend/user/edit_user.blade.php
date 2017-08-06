@extends('layouts.frontend.main')
@section('title', 'Edit User')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ol class="breadcrumb">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('my_listings')}}">My Listings</a></li>
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
                        <li role="presentation" class="active"><a href="{{route('login')}}">Update Account</a></li>
                        <li role="presentation"><a href="{{route('register_user')}}">Sign Up As Agent</a></li>
                    </ul>
                        <form data-email-validate="{{route('update_email_validate')}}" id="regform"
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
    <script src="/js/frontend/edit_account.js"></script>
@endsection