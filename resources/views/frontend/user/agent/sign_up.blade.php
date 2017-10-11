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
                        <li role="presentation"><a href="{{route('edit_account')}}">Update Account</a></li>
                            <li role="presentation" class="active"><a href="{{route('agent_sign_up')}}">Sign Up As
                                Agent</a></li>
                    </ul>

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
                    <form method="post" action="{{route('agent_sign_up_go')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="license_number">License No.</label>
                            <input type="text" name="license_number" id="license_number" class="form-control input-lg"
                                   placeholder="Enter License No.">
                        </div>
                        <div class="form-group">
                            <label for="license_number">Agent Type</label>
                            <select name="agent_type" id="agent_type" class="form-control input-lg">
                                <option value="agent">Real-Estate Broker (Agent)</option>
                                <option value="landlord">Landlord</option>
                                <option value="property_manager">Property Manager</option>
                                <option value="others">Other Real Estate Professional</option>
                            </select>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-lg btn-primary">
                    </form>
                    <!-- <div class="col-md-1">
                         <div class="sign-in-or"><img src="img/sign-in-or.png"><span>or</span></div>
                     </div>
                     <div class="col-md-4">
                         <div class="socal-login-buttons"> <a href="#" class="btn btn-social btn-lg btn-block btn-facebook"><i class="icon fa fa-facebook"></i> Sign In with Facebook</a> <a href="#" class="btn btn-social btn-lg btn-block btn-google"><i class="icon fa fa-google"></i> Sign In with Google</a> <a href="#" class="btn btn-social btn-lg btn-block btn-twitter"><i class="icon fa fa-twitter"></i> Sign In with Twitter</a> </div>
                     </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection