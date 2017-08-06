
$(function(){


    // get form variables
    const form = $("#regform");
    const name = $("#name");
    const email = $("#email");
    const password = $("#password");
    const password_confirm = $("#password-confirm");
    const name_error = $("#name-error");
    const email_error = $("#email-error");
    const password_error = $("#password-error");
    const password_confirm_error = $("#password-confirm-error");
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

        // make sure password confirmation is formatted properly
        if(password.val() !== '') {
            if (password_confirm.val() !== password.val()) {
                $("<div>Password confirmation and Password do not match</div>").appendTo(password_confirm_error);
                form_ok = false;
            }
        }

        // verify email
        if(form_ok){
            jQuery.ajax({
                url: form.data("email-validate"),
                type: "POST",
                data: {email: email.val().toLowerCase()},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function(dataresult){
                if(dataresult.email_unique == false) {
                    $("<div>An account with this email address already exists</div>").appendTo(email_error);
                } else {
                    // submit form
                    jQuery.ajax({
                        url: form.attr('action'),
                        type: "POST",
                        data: {
                            name: name.val(),
                            email: email.val(),
                            password: password.val(),
                            password_confirmation: password_confirm.val()
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        async: true,
                        timeout: 30000,
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
