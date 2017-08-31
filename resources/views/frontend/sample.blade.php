<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="page-header h3">Property for sale near {{$search_query}}</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div id="sidebar">
                            <div id="filters" class="card">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_budget" aria-expanded="true" aria-controls="p_type"> Budget <i class="fa fa-caret-down pull-right"></i> </a> </h4>
                                    </div>
                                    <div id="p_budget" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" placeholder="Min">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_type" aria-expanded="true" aria-controls="p_type"> Property Type <i class="fa fa-caret-down pull-right"></i> </a> </h4>
                                    </div>
                                    <div id="p_type" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Flats </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Houses </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Farms/Lands </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_features" aria-expanded="true" aria-controls="p_features"> Features <i class="fa fa-caret-down pull-right"></i> </a> </h4>
                                    </div>
                                    <div id="p_features" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Garden </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Parking/Garage </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Fireplace </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sorting">
                            <div class="form-group">
                                <select name="sort_order" class="form-control">
                                    <option selected="selected">Most recent</option>
                                    <option value="highest_price">Highest price</option>
                                    <option value="lowest_price">Lowest price</option>
                                    <option value="most_reduced">Most reduced</option>
                                    <option value="most_popular">Most popular</option>
                                </select>
                            </div>
                            <div class="btn-group pull-right" role="group">
                                  <a href="property_grid.html" class="btn btn-default"><i class="fa
                                 fa-th"></i></a>
                                 <a href="property_listing.html" class="btn btn-default">
                                     <i class="fa fa-bars"></i></a> </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="item-listing list">

                        @foreach($listings as $listing)

                            <!-- get bedrooms and bathrooms notated right -->
                                <?php
                                if($listing->bedrooms == 7){
                                    $bedrooms = "7+";
                                } else {
                                    $bedrooms = $listing->bedrooms;
                                }

                                if($listing->bathrooms == 6){
                                    $bathrooms = "6+";
                                } else {
                                    $bathrooms = $listing->bathrooms;
                                }
                                ?>

                                <div class="item" data-aos="fade-up">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="item-image"> <a href="property_single.html">

                                                    <!-- display listing image -->
                                                    @if(count($listing->images) > 1)
                                                        @foreach($listing->images as $image)
                                                            @if($image->profile)
                                                                <img class="img-responsive"
                                                                     src="{{$image->path}}" alt="">
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if(count($listing->images) < 2)
                                                        <img class="img-responsive"
                                                             src="{{$listing->images[0]->path}}" alt="">
                                                    @endif

                                                    @if($listing->type == 'sale')
                                                        <div class="item-for">For Sale</div>
                                                    @elseif($listing->type == 'rent')
                                                        <div class="item-for">For Lease</div>
                                                    @endif


                                                </a> </div>
                                            <div class="added-on">Listed {{$listing->created_at->diffForHumans()}}
                                                by </div>
                                            <div class="added-by">by <span>{{$listing->user->name}}</span></div>
                                        </div>
                                        <div class="col-md-8">
                                            <!-- <div class="added-by-photo"> <img src="img/demo/profile.jpg"
                                                                               class="img-rounded" width="64">
                                                                              </div> -->
                                            @if($listing->type == 'sale')
                                                <div class="item-price">${{number_format($listing->price)}}</div>
                                            @elseif($listing->type == 'rent')
                                                <div class="item-price">${{number_format($listing->price)}}
                                                    /month</div>
                                            @endif

                                            <h3 class="item-title"><a href="property_single
                                                .html">{{$listing->title}}</a></h3>
                                            <div class="item-details-i">
                                                <span class="bedrooms" data-toggle="tooltip" title="{{$bedrooms}}
                                                        Bedrooms">{{$bedrooms}} <i class="fa fa-bed"></i></span><span
                                                        class="bathrooms" data-toggle="tooltip"
                                                        title="{{$bathrooms}}
                                                                Bathrooms">{{$bathrooms}} <i class="fa
                                                            fa-bath"></i></span> </div>
                                            <div class="item-location">{{$listing->address->line_1}}
                                                {{$listing->address->line_2}},
                                                {{$listing->address->city}},
                                                {{$listing->address->state}}, {{$listing->address->zip}}</div>
                                            <div class="item-details">
                                                <ul>
                                                    <li>Sq Ft <span>{{number_format($listing->area)}}</span></li>
                                                </ul>
                                                <hr>
                                            </div>
                                            <div class="item-actions"> <a href="tel:020 8022 6348"><i class="fa
                                                fa-phone"></i> 020 8022 6348</a> <a href="#"  data-toggle="modal"
                                                                                    data-target="#leadform-{{$listing->id}}"><i
                                                            class="fa fa-envelope-o"></i> Contact</a> <a href="#"><i class="fa fa-star"></i> Save</a> </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$listings->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Agent Modal -->
@foreach($listings as $listing)
    <div class="modal fade  item-form" id="leadform-{{$listing->id}}" tabindex="-1" role="dialog"
         aria-labelledby="leadformLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media">
                        <div class="media-left"><a href="property_single.html"><img src="img/demo/property/1.jpg" class="img-rounded" width="64"></a></div>
                        <div class="media-body">
                            <h4 class="media-heading">Send Message for<br>
                                <small><a href="property_single.html">{{$listing->title}}</a></small></h4>
                            <ul class="list-unstyled">
                                <li>{{$listing->address->line_1}} {{$listing->address->line_2}},
                                    {{$listing->address->city}}, {{$listing->address->state}}
                                    {{$listing->address->zip}}</li>
                                <li><a href="tel:01502 392905"><i class="fa fa-phone fa-fw" aria-hidden="true"></i> Call: 01502 392905</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" class="form-control" id="" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" class="form-control" id="" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label>Your Telephone</label>
                            <input type="tel" class="form-control" id="" placeholder="Your Telephone">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea rows="4" class="form-control" placeholder="Please include any useful details, i.e. current status, availability for viewings, etc."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </div>
    </div>
@endforeach