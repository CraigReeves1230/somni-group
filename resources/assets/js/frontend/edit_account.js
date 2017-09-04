$(function(){


    // get form variables
    const form = $("#regform");
    const name = $("#name");
    const email = $("#email");
    const password = $("#password");
    const password_confirm = $("#password-confirm");
    const address_line_1 = $("#address_line_1");
    const address_line_2 = $("#address_line_2");
    const area_code = $("#area_code");
    const phone_number = $("#phone_number");
    const dob = $("#dob");
    const city = $("#city");
    const state = $("#state");
    const zip = $("#zip");
    const name_error = $("#name-error");
    const email_error = $("#email-error");
    const password_error = $("#password-error");
    const password_confirm_error = $("#password-confirm-error");
    const phone_number_error = $("#phone-number-error");
    const address_error = $("#address_error");
    const city_error = $("#city_error");
    const zip_error = $("#zip_error");
    const error_messages = $(".error-message");

    // regular expressions for validation
    const reg_ex_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;   // proper email formatting
    const reg_ex_password = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/;    // must contain at least 7 letters,
    // one number and one letter. No special characters or whitespace.

    // handle submission/errors
    form.on('submit', function(event) {

        // prevent submission until form is acceptable
        event.preventDefault();

        // empty out error messages
        error_messages.empty();

        // determine if form is ok with variable. By default it's true and is falsified if something is wrong
        // with the form
        let form_ok = true;

        // make sure name is acceptable
        if(name.val().length < 2) { // at least two characters
            $("<div>Name must be at least two characters</div>").appendTo(name_error);
            form_ok = false;
        }

        // make sure email is formatted properly
        if(!reg_ex_email.test(email.val())){
            $("<div>Email must be properly formatted</div>").appendTo(email_error);
            form_ok = false;
        }

        // make sure password is formatted properly
        if(password.val() !== '') {
            if (!reg_ex_password.test(password.val())) {
                $("<div>Password must be at least 7 characters and include 1 digit. No special characters or" +
                    " spaces.</div>").appendTo(password_error);
                form_ok = false;
            }
        }

        // make sure that address is properly formatted
        if(address_line_1.val() !== '' || address_line_2.val() !== '' || city.val() !== '' || zip.val() !== ''){
            if(address_line_1.val() === ''){
                $("<div>Address line 1 is required.</div>").appendTo(address_error);
                form_ok = false;
            }

            if(city.val() === ''){
                $("<div>City is required.</div>").appendTo(city_error);
                form_ok = false;
            }

            if(zip.val() === ''){
                $("<div>ZIP Code is required.</div>").appendTo(zip_error);
                form_ok = false;
            }
        }

        // make sure password confirmation is formatted properly
        if(password.val() !== '') {
            if (password_confirm.val() !== password.val()) {
                $("<div>Password confirmation and Password do not match</div>").appendTo(password_confirm_error);
                form_ok = false;
            }
        }

        // make sure area code exists
        if(area_code.val() == ''){
            $("<div>Phone number must have area code</div>").appendTo(phone_number_error);
            form_ok = false;
        }

        // make sure phone number exists
        if(phone_number.val() == ''){
            $("<div>Phone number is required</div>").appendTo(phone_number_error);
            form_ok = false;
        }

        // verify email and physical address
        if(form_ok){
            jQuery.ajax({
                url: form.data("email-address-validate"),
                type: "POST",
                data: {
                    email: email.val().toLowerCase(),
                    address_line_1: address_line_1.val(),
                    address_line_2: address_line_2.val(),
                    city: city.val(),
                    state: state.val(),
                    zip: zip.val()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function(dataresult){
                const email_unique = dataresult.email_unique;
                const real_address = dataresult.real_address;
                if(email_unique == false || real_address == false) {

                    // handle duplicate email
                    if(email_unique == false) {
                        $("<div>An account with this email address already exists</div>").appendTo(email_error);
                    }

                    // handle fake address
                    if(real_address == false){
                        $("<div>The address entered does not match postal records</div>").appendTo(address_error);
                    }
                } else {
                    // submit form
                    jQuery.ajax({
                        url: form.attr('action'),
                        type: "POST",
                        data: {
                            name: name.val(),
                            email: email.val(),
                            password: password.val(),
                            password_confirmation: password_confirm.val(),
                            area_code: area_code.val(),
                            dob: dob.val(),
                            phone_number: phone_number.val(),
                            address_line_1: address_line_1.val(),
                            address_line_2: address_line_2.val(),
                            city: city.val(),
                            state: state.val(),
                            zip: zip.val()
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        async: true,
                        timeout: 7000,
                        dataType: 'json'
                    }).done(function(responsedata){
                        // back to home
                        window.location.replace('/home');
                    });
                }
            })
        }
    });

});