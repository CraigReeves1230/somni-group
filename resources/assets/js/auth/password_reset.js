$(function(){


    // get variables
    const email = $("#email");
    const password = $("#password");
    const password_confirm = $("#password_confirm");
    const form = $("#form");
    const password_regex = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/;
    const password_error = $("#password_error");
    const email_error = $("#email_error");
    const error_messages = $(".error-message");
    const password_confirm_error = $("#password_confirm_error");

    form.submit(function(event) {
       event.preventDefault();
       error_messages.empty();
       let form_ok = true;

       if(!password_regex.test(password.val())){
           $("<div>Password must be at least 7 characters and include 1 digit. No special characters or" +
               " spaces.</div>").appendTo(password_error);
           form_ok = false;
       }

       if(password.val() !== password_confirm.val()){
            $("<div>Password and password confirmation do not match</div>").appendTo(password_error);
            form_ok = false;
       }

        // if form is ok, submit
        if(form_ok == true) {
            jQuery.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    password: password.val(),
                    email: email.val(),
                    password_confirmation: password_confirm.val(),
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async: true,
                timeout: 30000,
                dataType: 'json'
            })
            .done(function (responsedata) {
                window.location.replace('/');
            });
        }
    });
});