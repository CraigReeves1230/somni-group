import React, {Component} from 'react';

class Search extends Component{

    constructor(props){
        super(props);
        this.state = {
            text: ''
        };
    }

    render(){
        return(
            <div className="card">
                <div className="row">
                    <div className="col-md-6">
                        <div className="form-group">
                            <input type="text" name="search_field"
                                   className="form-control input-lg"
                                   placeholder="Country, State, County, City, Zip, Title, Address, ID."/>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="row">
                            <div className="col-md-4">
                                <div className="form-group">
                                    <select name="search_type" className="form-control input-lg">
                                        <option value="1">For Sale</option>
                                        <option value="2">For Rent</option>
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
        );
    }
}

export default Search;

