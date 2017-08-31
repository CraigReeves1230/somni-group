
import React, {Component} from 'react';
import SearchBar from './search_bar/SearchBar';
import SearchSummary from './search_summary/SearchSummary';
import SortOptions from './sort_options/SortOptions';
import SearchOptions from './search_options/SearchOptions';
import ResultsList from './results_list/ResultsList';

class App extends Component{

    constructor(props){
        super(props);
        this.state = ({listings: this.props.listings});
    }

    componentDidUpdate(){
        this.refs.results.setState({listings: this.state.listings});
    }

    renderSortOptions(){
        if(this.state.listings.length > 1){
            return(<SortOptions app={this} search_type={this.props.search_type} search_query={this.props.search_query} />);
        }
    }

    render(){
        return(
            <span>
                <SearchBar search_link={this.props.search_link} app={this} search_query={this.props.search_query} search_type={this.props.search_type} />
                <div id="content">
                    <div className="container">
                        <div className="row">
                            <div className="col-md-10 col-md-offset-1">
                                <SearchSummary app={this} search_type={this.props.search_type} search_query={this.props.search_query} />
                                <div className="row">
                                    <SearchOptions listings={this.props.listings} app={this} />
                                    <div className="col-md-9">
                                        {this.renderSortOptions()}
                                        <ResultsList ref="results" app={this} created_ats={this.props.created_ats} addresses={this.props.addresses} users={this.props.users} listings={this.props.listings} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </span>
        );
    }
}

export default App;