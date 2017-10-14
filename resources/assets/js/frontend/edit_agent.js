$(function(){

    // get all variables
    const license_number = $("#license_number");
    const agent_type = $("#agent_type");
    const address_line_1 = $("#address_line_1");
    const address_line_2 = $("#address_line_2");
    const city = $("#city");
    const state = $("#state");
    const zip = $("#zip");
    const address_line_1_error = $("#address-line-1-error");
    const address_line_2_error = $("#address-line-2-error");
    const city_error = $("#city-error");
    const zip_error = $("#zip-error");
    const form = $("#agent_form");
    const license_number_error = $("#license-number-error");

    form.submit((event) => {
        let form_ok = true;
        event.preventDefault();

        // make sure form is correct
        if(license_number.val() === ''){
            form_ok = false;
            $("<div>License number is required.</div>").appendTo(license_number_error);
        }

        if(address_line_1.val() === ''){
            form_ok = false;
            $("<div>Address line 1 is required.</div>").appendTo(address_line_1_error);
        }

        if(city.val() === ''){
            form_ok = false;
            $("<div>City is required.</div>").appendTo(city_error);
        }

        if(zip.val() === ''){
            form_ok = false;
            $("<div>ZIP Code is required.</div>").appendTo(zip_error);
        }

        // submit form
        if(form_ok){
            jQuery.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    agent_type: agent_type.val(),
                    license_number: license_number.val(),
                    address_line_1: address_line_1.val(),
                    address_line_2: address_line_2.val(),
                    city: city.val(),
                    state: state.val(),
                    zip: zip.val()
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function(responsedata){
                window.location.replace('/');
            });
        }
    });
});