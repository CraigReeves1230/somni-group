import React, {Component} from 'react';
import Pagination from '../pagination_component/Pagination';

class ResultsList extends Component{

    constructor(props){
        super(props);

        this.state = {
            records: this.props.records,
            pageOfItems: [],
            mode: 'list'
        };

        // handle pagination
        this.onChangePage = this.onChangePage.bind(this);
    }

    onChangePage(pageOfItems){
        // update state with a new page of items
        this.setState({pageOfItems});
    }

    renderRecord(record, index){

        // Display agent type
        let agent_type;
        switch(record.agent.agent_type){
            case 'agent':
                agent_type = 'Agent/Broker';
                break;
            case 'landlord':
                agent_type = 'Landlord';
                break;
            case 'property_manager':
                agent_type = 'Property Manager';
                break;
            case 'other':
                agent_type = 'Other';
                break;
        }

        // render the listing in list or grid mode
        if(this.state.mode === 'list') {
            return (
                <div className="item">
                    <div className="row">
                        <div className="col-md-4">
                            <div className="item-image"><a href="#">
                                <img className="img-responsive" src={record.profile_image} alt=""/>
                            </a></div>
                        </div>
                        <div className="col-md-8">
                            <div className="added-by-photo"> <a className="btn btn-primary">View Profile</a></div>
                            <div className="item-price"><a href="#">{record.agent.name}</a></div>
                            <h3 className="item-title">{agent_type}</h3>
                            <span style={{fontSize: 16}}><div className="item-location">{record.address.line_1} {record.address.line_2}, {record.address.city}, {record.address.state}, {record.address.zip}</div>
                            <div className="item-details">
                                <ul>
                                    <li>License No. <span>{record.agent.license_number}</span></li>
                                </ul>
                                <hr />
                            </div>
                            <div className="item-actions"><a href="#"><i
                                className="fa fa-phone"></i>{record.phone_number}</a>
                                <a href="#" data-toggle="modal" data-target={"#leadform-" + record.agent.id}><i
                                    className="fa fa-envelope-o"></i> Contact</a><a href="#"></a>
                            </div></span>
                        </div>
                    </div>
                </div>
            );
        } else if(this.state.mode === 'grid' ){
            return(
                <div className="col-md-4">
                    <div className="item">
                        <div className="item-image"><a href="property_single.html"><img src={record.profile_image} className="img-responsive" /></a>
                            </div>
                        <div className="item-price"><a href={record.agent.name}>{record.agent.name}</a></div>
                        <h3 className="item-title">{agent_type}</h3>
                        <span style={{fontSize: 16}}>
                            <div className="item-location">{record.address.line_1} {record.address.line_2}, {record.address.city}, {record.address.state}, {record.address.zip}</div>
                            <div className="item-actions"> <a href={record.phone_number}><i className="fa fa-phone"></i> {record.phone_number}</a> <a href="#"><i class="fa fa-envelope-o"></i></a></div>
                            <div className="item-actions">
                                <a style={{marginTop: 6, marginBottom: 6}} href="#" data-toggle="modal" data-target={"#leadform-" + record.agent.id}><i
                                    className="fa fa-envelope-o"></i> Contact</a><a href="#"></a>
                            </div>
                        </span>
                        <a style={{marginTop: 6}} href="#" className="btn btn-primary btn-block">View Profile</a>
                    </div>
                </div>
            );
        }
    }

    renderModal(record){
        return(
            <div className="modal fade  item-form" id={"leadform-" + record.agent.id} tabIndex="-1" role="dialog"
                 aria-labelledby="leadformLabel">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div className="media">
                                <div className="media-left"><a href="property_single.html"><img src={record.profile_image} className="img-rounded" width="64" /></a></div>
                                <div className="media-body">
                                    <h4 className="media-heading">Send Message for<br />
                                        <a href="property_single.html">{record.agent.name}</a></h4>
                                    <span style={{fontSize: 16}}>
                                        <ul className="list-unstyled">
                                            <li>{record.address.line_1} {record.address.line_2}, {record.address.city}, {record.address.state} {record.address.zip}</li>
                                            <li><a href={record.phone_number}><i className="fa fa-phone fa-fw" aria-hidden="true"></i> Call: {record.phone_number}</a></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div style={{fontSize: 16}} className="modal-body">
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
                {this.state.pageOfItems.map((record, index) => {
                    return this.renderRecord(record, index);
                })}
                {this.state.pageOfItems.map((record) => {
                    return this.renderModal(record);
                })}
                <Pagination items={this.state.records} perPageLimit="9" onChangePage={this.onChangePage} />
            </div>
        );
    }
}

export default ResultsList;