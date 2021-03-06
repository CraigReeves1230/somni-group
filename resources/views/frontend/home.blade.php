@extends('layouts.frontend.main')
@section('title', 'Aligning vision with Reality')
@section('content')
    <div class="main search-form">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="heading">
                        <h2>Find your new home</h2>
                        <h3>Its just a few clicks away</h3>
                    </div>

                    <!-- search form -->
                    <form action="{{route('listings_search')}}" method="POST">
                        {{csrf_field()}}
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="search_field"
                                               class="form-control input-lg"
                                               placeholder="Address, City, State, ZIP Code"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="search_type" class="form-control input-lg">
                                                    <option value="sale">For Sale</option>
                                                    <option value="rent">For Rent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="feature-box" data-aos="fade-up">
        <div class="container">
            <!-- flash messages -->
            @if(Session::has('info'))
                <div class="alert alert-info">{{session('info')}}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
           <!-- <div class="row">
                <div class="col-md-4">
                    <div class="image"> <img src="/img/demo/icons/1.png" width="80"> </div>
                    <h4>Lifestyle</h4>
                    <div class="caption">Create your best-ever home with the latest trends in renovating, decorating and more.</div>
                    <div class="button"><a href="#">FIND YOUR INSPIRATION</a></div>
                </div>
                <div class="col-md-4">
                    <div class="image"> <img src="/img/demo/icons/2.png" width="80"> </div>
                    <h4>International</h4>
                    <div class="caption">Thinking abroad? You can now dream and discover international properties.</div>
                    <div class="button"><a href="#">CHOOSE A COUNTRY</a></div>
                </div>
                <div class="col-md-4">
                    <div class="image"> <img src="/img/demo/icons/3.png" width="80"> </div>
                    <h4>Sell</h4>
                    <div class="caption">Understand your local market, learn how to get the best price for your property and find agents in your area.</div>
                    <div class="button"><a href="#">EXPLORE NOW</a></div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- <div class="feature-box gray" data-aos="fade-up">
        <div class="container">
            <div class="main-title">Featured Properties</div>
            <div class="main-title-description">Thinking abroad? You can now dream and discover international properties</div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="item-listing grid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="item">
                                    <div class="item-image"> <img src="/img/demo/property/1.jpg"
                                                                  class="img-responsive">
                                        <div class="item-for">For Sale</div>
                                        <a href="#" class="save-item"><i class="fa fa-star"></i></a> </div>
                                    <div class="item-price">From $1,875 /month</div>
                                    <h3 class="item-title">3 bed semi-detached house for sale</h3>
                                    <div class="item-details-i"> <span class="bedrooms" data-toggle="tooltip" title="" data-original-title="3 Bedrooms">3 <i class="fa fa-bed"></i></span> <span class="bathrooms" data-toggle="tooltip" title="" data-original-title="2 Bathrooms">2 <i class="fa fa-bath"></i></span> </div>
                                    <div class="item-location">Kirkstone Road, Middlesbrough TS3</div>
                                    <div class="item-actions"> <a href="tel:020 8022 6348"><i class="fa fa-phone"></i> 020 8022 6348</a> <a href="#"><i class="fa fa-envelope-o"></i></a></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item">
                                    <div class="item-image"> <img src="/img/demo/property/2.jpg"
                                                                  class="img-responsive">
                                        <div class="item-for">For Sale</div>
                                        <a href="#" class="save-item"><i class="fa fa-star"></i></a> </div>
                                    <div class="item-price">From $1,875 /month</div>
                                    <h3 class="item-title">3 bed semi-detached house for sale</h3>
                                    <div class="item-details-i"> <span class="bedrooms" data-toggle="tooltip" title="" data-original-title="3 Bedrooms">3 <i class="fa fa-bed"></i></span> <span class="bathrooms" data-toggle="tooltip" title="" data-original-title="2 Bathrooms">2 <i class="fa fa-bath"></i></span> </div>
                                    <div class="item-location">Kirkstone Road, Middlesbrough TS3</div>
                                    <div class="item-actions"> <a href="tel:020 8022 6348"><i class="fa fa-phone"></i> 020 8022 6348</a> <a href="#"><i class="fa fa-envelope-o"></i></a></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item">
                                    <div class="item-image"> <img src="/img/demo/property/3.jpg"
                                                                  class="img-responsive">
                                        <div class="item-for">For Sale</div>
                                        <a href="#" class="save-item"><i class="fa fa-star"></i></a> </div>
                                    <div class="item-price">From $1,875 /month</div>
                                    <h3 class="item-title">3 bed semi-detached house for sale</h3>
                                    <div class="item-details-i"> <span class="bedrooms" data-toggle="tooltip" title="" data-original-title="3 Bedrooms">3 <i class="fa fa-bed"></i></span> <span class="bathrooms" data-toggle="tooltip" title="" data-original-title="2 Bathrooms">2 <i class="fa fa-bath"></i></span> </div>
                                    <div class="item-location">Kirkstone Road, Middlesbrough TS3</div>
                                    <div class="item-actions"> <a href="tel:020 8022 6348"><i class="fa fa-phone"></i> 020 8022 6348</a> <a href="#"><i class="fa fa-envelope-o"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="feature-box testimonials" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div id="testimonials" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="image"> <img class="img-circle" src="/img/demo/profile.jpg" width="180"
                                                     alt="">
                                <h4>Thank you for your quick and clear responses. They are much appreciated. This was a site that needed to go up fast and it has – customizations and all!</h4>
                                <div class="caption">The Brown Family</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="image"> <img class="img-circle" src="/img/profile-placeholder.jpg"
                                                     width="180" alt="">
                                <h4>Thank you for your quick and clear responses. They are much appreciated. This was a site that needed to go up fast and it has – customizations and all!</h4>
                                <div class="caption">The Brown Family</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="image"> <img class="img-circle" src="/img/profile-placeholder.jpg"
                                                     width="180" alt="">
                                <h4>Thank you for your quick and clear responses. They are much appreciated. This was a site that needed to go up fast and it has – customizations and all!</h4>
                                <div class="caption">The Brown Family</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#testimonials").owlCarousel({
                navigation : true,
                singleItem:true
            });
        });
    </script> -->
@endsection
