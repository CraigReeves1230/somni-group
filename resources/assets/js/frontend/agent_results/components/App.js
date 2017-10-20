import React from 'react';
import SearchBar from '../components/search_bar/SearchBar.jsx';
import SearchSummary from '../components/search_summary/SearchSummary.jsx';
import ResultsList from '../components/results_list/ResultsList.jsx';

class App extends React.Component{

    constructor(props){
        super(props);
        this.state = ({records: this.props.records});
    }

    componentDidUpdate(){
        this.refs.results.setState({records: this.state.records});
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
                                    <div className="col-md-9">
                                        <ResultsList ref="results" search_query={this.props.search_query} app={this} records={this.props.records} />
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
