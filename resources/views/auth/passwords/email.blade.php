@extends('layouts.frontend.main')
@section('title', 'Password Reset Request')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ol class="breadcrumb">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                    </ol>
                    <h1 class="page-header">Forgot Password</h1>
                    <p>Please enter the email address you registered with website below and we'll email you a link to a page where you can easily create a new password.</p>
                    <form action="{{ route('password_reset') }}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Email address</label>
                            <input id="email" type="email" name="email" class="form-control input-lg"
                                   placeholder="Email Address">
                        </div>
                        <input type="submit" value="Reset Password" class="btn btn-primary btn-lg">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/bundle.js"></script>
@endsection
