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
        if (this.props.app.state.records.length > 0 && this.props.app.state.records !== null) {
            // only if wildcard search isnt used...
            if(this.state.search_query !== '*') {
                return (
                    <h1 className="page-header h3">{this.stateType()} near {this.state.search_query}</h1>
                );
            } else {
                // if wildcard search is used, display a general message
                return (
                    <h1 className="page-header h3">All listings for {this.stateType()}...</h1>
                );
            }
        } else {
            return (
                <h1 className="page-header h3">No results from your search could be found.</h1>
            );
        }
    }

    stateType(){
        let display_name;
        switch(this.state.search_type) {
            case 'agent':
                display_name = 'Agents';
                break;
            case 'landlord':
                display_name = 'Landlords';
                break;
            case 'property_manager':
                display_name = 'Property Managers';
                break;
            case 'other':
                display_name = 'Others';
                break;
        }

        return display_name;
    }

    render(){
        return this.renderSummary();
    }
}

export default SearchSummary;