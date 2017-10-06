@extends('layouts.admin.main')
@section('content')

    <style>
        .item-box{
            border-style: groove;
            border-radius: 10px;
            margin-left: 15px;
            margin-right: 15px;
            margin-top: 15px;
            padding: 10px;
        }

        .stat-title{
            margin-left: 10px;
            color: brown;
        }

        .stat{
            margin-left: 10px;
        }
    </style>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <h2>Consultations</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <nav>
                <div class="container-fluid nav-container">
                    <ul class="menu-main">
                        <li class="nav-item has-submenu"><a href="#">Today</a></li>
                        <li class="nav-item has-submenu"><a href="#">Pending</a></li>
                        <li class="nav-item"><a href="#">Missed</a></li>
                        <li class="nav-item"><a href="#">Completed</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- mobile menu -->
    <div class="container-fluid mobile-nav-container px-0">
        <div class="mobile-menu">
            <!-- this is populated automatically with javascript -->
        </div>
    </div>
    <div class="mobile-handle"><i class="fa fa-bars"></i></div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 item-box">
                <div class="row"><b class="stat-title">Date:</b><b class="stat">9/17/2017</b></div>
                <div class="row"><b class="stat-title">Time:</b><b class="stat">1:28 PM EST</b></div>
                <div class="row"><b class="stat-title">Listing:</b><b class="stat">Really nice, house...</b></div>
                <div class="row"><b class="stat-title">Preferred Contact Method:</b><b class="stat"><i class="fa
                fa-phone"></i>
                        Phone</b></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 item-box">
                <div class="row"><b class="stat-title">Date:</b><b class="stat">9/17/2017</b></div>
                <div class="row"><b class="stat-title">Time:</b><b class="stat">1:28 PM EST</b></div>
                <div class="row"><b class="stat-title">Listing:</b><b class="stat">Really nice, house...</b></div>
                <div class="row"><b class="stat-title">Preferred Contact Method:</b><b class="stat"><i class="fa
                    fa-phone"></i>
                        Phone</b></div>
            </div>
        </div>

@endsection