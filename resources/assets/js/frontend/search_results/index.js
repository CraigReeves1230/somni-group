
import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App';

// set variables
const root = document.getElementById("react_root");
let listings = JSON.parse(root.dataset.listings);
let search_query = root.dataset.searchQuery;
let search_type = root.dataset.searchType;
let search_link = root.dataset.searchLink;

// get users
if(listings.length > 0) {
    $.ajax({
        url: "/listings/get_all_data",
        type: "POST",
        data: {listings},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        async: true,
        timeout: 7000,
        dataType: 'json'
    }).done((responsedata) => {
        let users = responsedata.users;
        let addresses = responsedata.addresses;
        let created_ats = responsedata.created_ats;
        let coords = responsedata.coords;
        let user_avatars = responsedata.user_avatars;
        let phone_numbers = responsedata.phone_numbers;

        // compile listings
        let listings_array = [];
        if (listings !== null && listings.length > 0) {
            listings.map((listing, index) => {

                // create listing object
                let listing_obj = {
                    title: listing.title,
                    price: listing.price,
                    address: {
                        line_1: addresses[index].line_1,
                        line_2: addresses[index].line_2,
                        city: addresses[index].city,
                        state: addresses[index].state,
                        zip: addresses[index].zip,
                        latitude: coords[index].latitude,
                        longitude: coords[index].longitude
                    },
                    mls: listing.mls,
                    description: listing.description,
                    user: {
                        name: users[index].name,
                        email: users[index].email,
                        is_agent: users[index].agent,
                        is_admin: users[index].admin,
                        is_master: users[index].master,
                        created_at: created_ats[index],
                        phone_number: phone_numbers[index],
                        avatar: user_avatars[index]
                    },
                    bedrooms: listing.bedrooms,
                    bathrooms: listing.bathrooms,
                    type: listing.type,
                    area: listing.area,
                    location: listing.location,
                    year_built: listing.year_built,
                    id: listing.id,
                    status: listing.status,
                    profile_image: listing.profile_image,
                    created_at: created_ats[index]
                };

                // add listing object to array
                listings_array.push(listing_obj);
            });
        }

        ReactDOM.render(<App
            search_link={search_link}
            created_ats={created_ats}
            addresses={addresses}
            users={users}
            listings={listings_array}
            search_type={search_type}
            search_query={search_query}/>, root);
    });
} else {

    // Search returned no results

    ReactDOM.render(<App
        search_link={search_link}
        created_ats={[]}
        addresses={[]}
        users={[]}
        listings={[]}
        search_type={search_type}
        search_query={search_query}/>, root);
}






