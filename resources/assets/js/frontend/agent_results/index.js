import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';

const root = document.getElementById("agent_results");
const records = $(root).data('records');
const search_type = $(root).data('search_type');
const search_link = $(root).data('search_link');
const search_query = $(root).data('search_query');

ReactDOM.render(<div><h1><App search_query={search_query} search_link={search_link} records={records} search_type={search_type} /></h1></div>, root);

