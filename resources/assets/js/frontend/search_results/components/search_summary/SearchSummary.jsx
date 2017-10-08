import React, {Component} from 'react';

class SearchSummary extends Component{

    constructor(props){
        super(props);

        this.state = {
            search_query: this.props.search_query,
            search_type: this.props.search_type,
        }
    }

    renderSummary(){
        // we only want to list by location if the wildcard search isn't used
        if (this.props.app.state.listings.length > 0 && this.props.app.state.listings !== null) {
            // only if wildcard search isnt used...
            if(this.state.search_query !== '*') {
                return (
                    <h1 className="page-header h3">{this.pluarlizeProperty()} {this.stateType()}
                        near {this.state.search_query}</h1>
                );
            } else {
                // if wildcard search is used, display a general message
                return (
                    <h1 className="page-header h3">All listings for {this.state.search_type}...</h1>
                );
            }
        } else {
            return (
                <h1 className="page-header h3">No results from your search could be found.</h1>
            );
        }
    }

    pluarlizeProperty(){
        if(this.props.app.state.listings !== null) {
            if (this.props.app.state.listings.length > 1) {
                return (<span>Properties</span>);
            } else if (this.props.app.state.listings.length == 1) {
                return (<span>Property</span>);
            }
        }
    }

    stateType(){
        if(this.state.search_type == 'sale'){
            return(<span>for sale </span>)
        } else if(this.state.search_type == 'rent'){
            return(<span>for rent </span>)
        }
    }

    render(){
        return this.renderSummary();
    }
}

export default SearchSummary;