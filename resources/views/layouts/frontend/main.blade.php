<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Somni Group - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/lib/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/lib/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/lib/aos/aos.css" rel="stylesheet">
    <link href="/lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
    <link href="/css/frontend/style.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/lib/jquery-3.2.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="/lib/aos/aos.js"></script>
    <script src="/lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
    <script src="/lib/jquery.sticky-sidebar-scroll.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!};
    </script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-transparent" id="menu">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="{{route('index')}}"><img height="80" src="/img/somni-logo-main.png" />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="property_listing.html">For Rent</a></li>
                <li><a href="property_grid.html">For Sale</a></li>
                <li><a href="agent_list.html">Agents</a></li>
                @if(!Auth::guest())
                    <li><a href="{{route('my_listings')}}">My Listings</a></li>
                @endif
                <li><a href=""></a></li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                         aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                    <ul class="dropdown-menu mega">
                        <li class="navbar-text">
                            <div class="column">
                                <ul class="list-unstyled">
                                    <li class="title"><a href="{{route('index')}}">Homepage</a></li>
                                    <!-- these will vary depending on if user is logged in -->
                                    @if(Auth::guest())
                                        <li class="title">Login/Signup Pages</li>
                                        <li><a href="{{route('login_user')}}">Sign In</a></li>
                                        <li><a href="{{route('register_user')}}">Register</a></li>
                                        <li><a href="{{route('password_reset')}}">Forgot Password</a></li>
                                    @else
                                        <li><a href="{{route('edit_account')}}">My Account</a></li>
                                        <li><a href="{{route('logout')}}">Sign Out</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="column">
                                <ul class="list-unstyled">
                                    <li class="title">Agent Pages</li>
                                    <li><a href="agent_list.html">Agent List</a></li>
                                    <li><a href="agent.html">Agent Profile</a></li>
                                    <li class="title"><a href="#">Property pages</a></li>
                                    <li><a href="{{route('my_listings')}}">My Listings</a></li>
                                    <li><a href="property_grid.html">Property Grid View</a></li>
                                    <li><a href="property_single.html">Property Single View</a></li>
                                    <li><a href="{{route('add_listing')}}">Add Listing</a></li>
                                    <li><a href="compare.html">Compare Properties</a></li>
                                </ul>
                            </div>
                            <div class="column">
                                <ul class="list-unstyled">
                                    <li class="title">Other Pages</li>
                                    <li><a href="plans.html">Plans</a></li>
                                    <li><a href="information_page.html">Information Page</a></li>
                                    <li><a href="coming_soon.html">Coming Soon</a></li>
                                    <li><a href="404_error.html">Error Page</a></li>
                                    <li><a href="contact.html">Contact Page</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="add-listing visible-md visible-lg"><a href="{{route('add_listing')}}"><span><i class="fa
                fa-plus" aria-hidden="true"></i> Add listing</span></a></li>

                <!-- this varies depending on if user is signed in -->
                @if(Auth::guest())
                    <li class="signin"><a href="{{route('login_user')}}"><span>Sign In</span></a></li>
                    <li class="register"><a href="{{route('register_user')}}"><span>Register</span></a></li>
                @else
                    <li><a href="{{route('edit_account')}}">Hi, {{Auth::user()->name}}!</a></li>
                    <li><a href="{{route('logout')}}">Sign Out</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4">
                        <p><img src="/img/somni-logo-main.png" /></p>
                        <address>
                            <strong>The Somni Group</strong><br>
                            1355 Market Street, Suite 900<br>
                            San Francisco, CA 94103<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        <p class="text-muted">Copyright &copy; 2017 The Somni Group<br />
                            All rights reserved</p>
                    </div>
                    <div class="col-md-2">
                        <ul class="list-unstyled">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Plans</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="list-unstyled">
                            <li><a href="#">For Rent</a></li>
                            <li><a href="#">For Sale</a></li>
                            <li><a href="#">Commercial</a></li>
                            <li><a href="#">Agents</a></li>
                            <li><a href="#">Property Guides</a></li>
                            <li><a href="#">Jobs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="social-sharebox"> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-google"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-youtube-play"></i></a> <a href="#"><i class="fa fa-pinterest"></i></a> </div>
                        <form>
                            <h4>Subscribe Newsletter</h4>
                            <div class="input-group input-group-lg">
                                <input type="email" class="form-control" placeholder="Email Address">
                                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">Go!</button>
                    </span> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({container: 'body'});
        //$('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script type="text/javascript">
    AOS.init({
        offset: 30
    });
</script>
<script>
    var footer_height = $('#footer').outerHeight() + 30;
    if (document.getElementById('sidebar')) {
        $(document).ready(function() {
            $.stickysidebarscroll("#sidebar",{offset: {top: 20, bottom: footer_height}});
        });
    };
</script>
</body>
</html>