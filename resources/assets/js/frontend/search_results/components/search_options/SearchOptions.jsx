import React, {Component} from 'react';

class SearchOptions extends Component{

    constructor(props){
        super(props);

        this.state = {
            min: '',
            max: ''
        };
    }

    limitRangeByBudget(min, max) {
        this.setState({
            min, max
        });

        if(this.state.min !== '' && this.state.max !== ''){

            // filter out listings array
            let listings = this.props.listings;

            // create new listings array based on budget range
            let new_listings = [];
            listings.map((listing) => {
                if(listing.price >= min && listing.price <= max){
                    new_listings.push(listing);
                }
            });

            // update the results state so that it can update the listings
            this.props.app.setState({listings: new_listings});
        } else {
            // list all available listings
            this.props.app.setState({listings: this.props.listings});
        }
    }

    render(){
        return(
            <div className="col-md-3">
                <div id="sidebar">
                    <div id="filters" className="card">
                        <div className="panel panel-default">
                            <div className="panel-heading" role="tab" id="headingOne">
                                <h4 className="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_budget" aria-expanded="true" aria-controls="p_type"> Budget <i className="fa fa-caret-down pull-right"></i> </a> </h4>
                            </div>
                            <div id="p_budget" className="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div className="panel-body">
                                    <div className="row">
                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <input type="text" onChange={(event) => this.limitRangeByBudget(event.target.value, this.state.max)} className="form-control input-sm" placeholder="Min" />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <input type="text" onChange={(event) => this.limitRangeByBudget(this.state.min, event.target.value)} className="form-control input-sm" placeholder="Max" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
}

export default SearchOptions;