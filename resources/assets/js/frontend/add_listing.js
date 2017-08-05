
$(function(){

    // get all variables
    const form = $("#form");
    const title = $("#title");
    const type = $("#type");
    const price = $("#price");
    const bedrooms = $("#bedrooms");
    const bathrooms = $("#bathrooms");
    const area = $("#area");
    const mls = $("#mls");
    const location = $("#location");
    const address = $("#address");
    const address_line_2 = $("#address_line_2");
    const city = $("#city");
    const state = $("#state");
    const zip = $("#zip");
    const description = $("#description");
    const feature = $("#feature");

    const title_error = $("#title-error");
    const price_error = $("#price-error");
    const bedrooms_error = $("#bedrooms-error");
    const bathrooms_error = $("#bathrooms-error");
    const area_error = $("#area-error");
    const mls_error = $("#mls-error");
    const address_error = $("#address-error");
    const city_error = $("#city-error");
    const state_error = $("#state-error");
    const zip_error = $("#zip-error");
    const geolocator_error = $("#geolocator-error");
    const error_messages = $(".error-message");

    const price_regex = /^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/; // numbers only. no currency sign
    const area_regex = /^[0-9]+$/; // numbers only

    form.submit(function(event){

        event.preventDefault();
        let form_ok = true;
        error_messages.empty();

        if(title.val() == ""){
            form_ok = false;
            $("<div>Title is required</div>").appendTo(title_error);
        }

        if(!price_regex.test(price.val())){
            form_ok = false;
            $("<div>Price must be a number. Do not include currency sign</div>").appendTo(price_error);
        }

        if(bedrooms.val() == ''){
            form_ok = false;
            $("<div>Bedrooms is required</div>").appendTo(bedrooms_error);
        }

        if(bathrooms.val() == ''){
            form_ok = false;
            $("<div>Bathrooms is required</div>").appendTo(bathrooms_error);
        }

        if(!area_regex.test(area.val())){
            form_ok = false;
            $("<div>Area must be a number. No commas</div>").appendTo(area_error);
        }

        if(mls.val() == ''){
            form_ok = false;
            $("<div>MLS is required</div>").appendTo(mls_error);
        }

        if(address.val() == ''){
            form_ok = false;
            $("<div>Address is required</div>").appendTo(address_error);
        }

        if(city.val() == ''){
            form_ok = false;
            $("<div>City is required</div>").appendTo(city_error);
        }

        if(state.val() == ''){
            form_ok = false;
            $("<div>State is required</div>").appendTo(state_error);
        }

        if(zip.val() == ''){
            form_ok = false;
            $("<div>ZIP Code is required</div>").appendTo(zip_error);
        }

        // submit form if all checks out
        if(form_ok){
            jQuery.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    title: title.val(),
                    type: type.val(),
                    price: price.val(),
                    bedrooms: bedrooms.val(),
                    bathrooms: bathrooms.val(),
                    area: area.val(),
                    mls: mls.val(),
                    location: location.val(),
                    address: address.val(),
                    address_line_2: address_line_2.val(),
                    city: city.val(),
                    state: state.val(),
                    description: description.val(),
                    zip: zip.val()
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function(responsedata){
                if(responsedata.ok == true) {
                    // redirect back to home page
                    window.location.replace('/listings/my_listings');
                } else {
                    // display error message
                    $("<div>" + responsedata.msg + "</div>").appendTo(geolocator_error);
                }
            });
        }
    });

});