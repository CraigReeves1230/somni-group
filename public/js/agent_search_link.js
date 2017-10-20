
$(function(){

    // get variables
    const agents_selection = $("#agents_selection");
    let guest = $(agents_selection).data("guest");
    let user = $(agents_selection).data("user");
    let user_address = $(agents_selection).data("address");
    let url = $(agents_selection).data("url");
    let search_type = "agent";

    // handle clicking on link
    $(agents_selection).on('click', function(event){

        // set search query
        let search_query;
        if(guest !== false && user_address !== null){
            search_query = user_address.line_1 + " " + user_address.city + " " + user_address.zip;
        } else {
            search_query = "*";
        }

        console.log(search_query);

        $.ajax({
            url: url,
            data: {
                search_type: search_type,
                search_field: search_query
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async: true,
            timeout: 7000,
            dataType: 'json'
        });
    });

});
