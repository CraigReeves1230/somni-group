
import React, {Component} from 'react';

class SearchBar extends Component{

    constructor(props){
        super(props);

        this.state = {
            search_query: this.props.search_query,
            search_type: this.props.search_type
        };
    }

    submitSearch(event) {
        event.preventDefault();
        $.ajax({
            url: this.props.search_link,
            type: "POST",
            data: {search_field: this.state.search_query, search_type: this.state.search_type},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async: true,
            timeout: 7000,
            dataType: 'json'
        }).done((responsedata) => {
            window.location.href = responsedata.search_results_link;
        });
    }

    render(){
        return(
            <div className="container">
                <div className="search-form">
                    <form onSubmit={(event) => this.submitSearch(event)} method="POST" action={this.props.search_link}>
                        <div className="card">
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="form-group">
                                        <input name="search_field" type="text" className="form-control input-lg"
                                           placeholder="Address, City, State, ZIP Code"
                                               value={this.state.search_query} onChange={(event) => this.setState({search_query: event.target.value})}
                                            />
                                    </div>
                                </div>
                            <div className="col-md-6">
                                <div className="row">
                                    <div className="col-md-4">
                                        <div className="form-group">
                                            <select onChange={(event) => this.setState({search_type: event.target.value})} defaultValue={this.state.search_type} name="search_type" className="form-control input-lg">
                                                <option
                                                        value="sale">For Sale</option>
                                                <option
                                                        value="rent">For Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div className="col-md-4">
                                        <div className="form-group">
                                            <button type="submit" className="btn btn-lg btn-primary btn-block">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        );
    }

}

export default SearchBar;