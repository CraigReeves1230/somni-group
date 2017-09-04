import React, {Component} from 'react';

class SortOptions extends Component{

    sortResults(event){

        if(event.target.value == "most_recent") {
            let listings = this.props.app.state.listings;
            listings.sort((a, b) => b.id - a.id);
            this.props.app.setState({listings: [...listings]});
        }

        if(event.target.value == "highest_price") {
            let listings = this.props.app.state.listings;
            listings.sort((a, b) => b.price - a.price);
            this.props.app.setState({listings: [...listings]});
        }

        if(event.target.value == "lowest_price") {
            let listings = this.props.app.state.listings;
            listings.sort((a, b) => a.price - b.price);
            this.props.app.setState({listings: [...listings]});
        }
    }

    render(){
        return(
            <span>
                <div className="sorting">
                    <form className="form-inline">
                        <div className="form-group">
                            <select onChange={(event) => this.sortResults(event)} name="sort_order" className="form-control">
                                <option selected="selected">Sort by</option>
                                <option value="most_recent">Most recent</option>
                                <option value="highest_price">Highest price</option>
                                <option value="lowest_price">Lowest price</option>
                            </select>
                        </div>
                        <div className="btn-group pull-right" role="group">
                              <a onClick={() => this.props.app.refs.results.setState({mode: 'grid'})} className="btn btn-default"><i className="fa
                             fa-th"></i></a>
                             <a onClick={() => this.props.app.refs.results.setState({mode: 'list'})} className="btn btn-default">
                                 <i className="fa fa-bars"></i></a> </div>
                        </form>
                    </div>
                <div className="clearfix"></div>
            </span>
        );
    }
}

export default SortOptions;