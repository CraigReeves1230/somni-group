import React, {Component} from 'react';
import Pagination from '../pagination_component/Pagination';

class ResultsList extends Component{

    constructor(props){
        super(props);

        this.state = {
            listings: this.props.listings,
            pageOfItems: [],
            mode: 'list'
        };

        // file location prefix for images
        this.image_prefix = '/img/';

        // handle pagination
        this.onChangePage = this.onChangePage.bind(this);
    }

    onChangePage(pageOfItems){
        // update state with a new page of items
        this.setState({pageOfItems});
    }

    renderYearBuilt(listing){
        if(listing.year_built !== null){
            return(
                <span>
                    <li>Year Built <span>{listing.year_built}</span></li>
                </span>
            );
        }
    }

    renderListing(listing, index){

        // make sure number of bed and bathrooms is notated correctly
        let bedrooms;
        let bathrooms;
        if(listing.bedrooms == 7){
            bedrooms = "7+";
        } else {
            bedrooms = listing.bedrooms;
        }
        if(listing.bathrooms == 6){
            bathrooms = "6+";
        } else {
            bathrooms = listing.bathrooms;
        }

        // determine if for sale or for rent
        let type;
        if(listing.type == 'sale'){
            type = 'For Sale';
        } else if(listing.type == 'rent') {
            type = 'For Lease'
        }

        // Display listing type
        let listing_type;
        if(listing.type == 'rent'){
            listing_type = 'For Lease'
        } else if(listing.type == 'sale') {
            listing_type = 'For Sale'
        }

        // get price
        let listing_price;
        if(listing.type == 'rent'){
            listing_price = listing.price;
            listing_price = listing_price.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            listing_price = "$" + listing_price + " /month"
        } else if(listing.type == 'sale'){
            listing_price = listing.price;
            listing_price = "$" + listing_price.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }

        // render the listing in list or grid mode
        if(this.state.mode === 'list') {
            return (
                <div className="item">
                    <div className="row">
                        <div className="col-md-4">
                            <div className="item-image"><a href="property_single.html">
                                <img className="img-responsive" src={this.image_prefix + listing.profile_image} alt=""/>
                                <div className="item-for">{type}</div>
                            </a></div>
                            <div className="added-on">Listed {listing.created_at} by</div>
                            <div className="added-by">by <span>{listing.user.name}</span></div>
                        </div>
                        <div className="col-md-8">
                            <div className="added-by-photo"> <img src={listing.user.avatar} className="img-rounded" width="64" /></div>
                            <div className="item-price">{listing_price}</div>
                            <h3 className="item-title"><a href="property_single.html">{listing.title}</a></h3>
                            <div className="item-details-i">
                                <span className="bedrooms" data-toggle="tooltip"
                                      title={bedrooms + " Bedrooms"}>{bedrooms} <i className="fa fa-bed"></i></span>
                                <span className="bathrooms" data-toggle="tooltip"
                                      title={bathrooms + " Bathrooms"}>{bathrooms} <i className="fa fa-bath"></i></span>
                            </div>
                            <div className="item-location">{listing.address.line_1} {listing.address.line_2}, {listing.address.city}, {listing.address.state}, {listing.address.zip}</div>
                            <div className="item-details">
                                <ul>
                                    <li>Sq Ft <span>{listing.area}</span></li>
                                    {this.renderYearBuilt(listing)}
                                </ul>
                                <hr />
                            </div>
                            <div className="item-actions"><a href="#"><i
                                className="fa fa-phone"></i>{listing.user.phone_number}</a>
                                <a href="#" data-toggle="modal" data-target={"#leadform-" + listing.id}><i
                                    className="fa fa-envelope-o"></i> Contact</a><a href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            );
        } else if(this.state.mode === 'grid' ){
            return(
                <div className="col-md-4">
                    <div className="item">
                        <div className="item-image"><a href="property_single.html"><img src={this.image_prefix + listing.profile_image} className="img-responsive" /></a>
                            <div className="item-for">{type}</div>
                            </div>
                        <div className="item-price">{listing_price}</div>
                        <h3 className="item-title">{listing.title}</h3>
                        <div className="item-details-i"> <span className="bedrooms" data-toggle="tooltip" title="3 Bedrooms">3 <i className="fa fa-bed"></i></span> <span className="bathrooms" data-toggle="tooltip" title="2 Bathrooms">2 <i className="fa fa-bath"></i></span> </div>
                        <div className="item-location">{listing.address.line_1} {listing.address.line_2}, {listing.address.city}, {listing.address.state}, {listing.address.zip}</div>
                        <div className="item-actions"> <a href={listing.user.phone_number}><i className="fa fa-phone"></i> {listing.user.phone_number}</a> <a href="#"><i class="fa fa-envelope-o"></i></a></div>
                    </div>
                </div>
            );
        }
    }

    renderModal(listing){
        return(
            <div className="modal fade  item-form" id={"leadform-" + listing.id} tabIndex="-1" role="dialog"
                 aria-labelledby="leadformLabel">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div className="media">
                                <div className="media-left"><a href="property_single.html"><img src={this.image_prefix + listing.profile_image} className="img-rounded" width="64" /></a></div>
                                <div className="media-body">
                                    <h4 className="media-heading">Send Message for<br />
                                        <small><a href="property_single.html">{listing.title}</a></small></h4>
                                    <ul className="list-unstyled">
                                        <li>{listing.address.line_1} {listing.address.line_2}, {listing.address.city}, {listing.address.state} {listing.address.zip}</li>
                                        <li><a href={listing.user.phone_number}><i className="fa fa-phone fa-fw" aria-hidden="true"></i> Call: {listing.user.phone_number}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div className="modal-body">
                            <form>
                                <div className="form-group">
                                    <label>Your Name</label>
                                    <input type="text" className="form-control" id="" placeholder="Your Name" />
                                </div>
                                <div className="form-group">
                                    <label>Your Email</label>
                                    <input type="email" className="form-control" id="" placeholder="Your Email" />
                                </div>
                                <div className="form-group">
                                    <label>Your Telephone</label>
                                    <input type="tel" className="form-control" id="" placeholder="Your Telephone" />
                                </div>
                                <div className="form-group">
                                    <label>Message</label>
                                    <textarea rows="4" className="form-control" placeholder="Please include any useful details, i.e. current status, availability for viewings, etc."></textarea>
                                </div>
                            </form>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-link" data-dismiss="modal">Cancel</button>
                            <button type="button" className="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    render(){
        return(
            <div className={"item-listing " + this.state.mode}>
                {this.state.pageOfItems.map((listing, index) => {
                    return this.renderListing(listing, index);
                })}
                {this.state.pageOfItems.map((listing) => {
                    return this.renderModal(listing);
                })}
                <Pagination items={this.state.listings} perPageLimit="9" onChangePage={this.onChangePage} />
            </div>
        );
    }
}

export default ResultsList;