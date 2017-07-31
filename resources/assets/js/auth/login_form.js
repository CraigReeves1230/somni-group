
// handles user registration
$(function(){

    // get form variables
    const form = $("#form");
    const email = $("#email");
    const password = $("#password");
    const error_message = $("#error");
    const remember = $("#remember");

    // handle submission/errors
    form.on('submit', function(event) {

        // prevent submission until form is acceptable
        event.preventDefault();

        // empty out error messages
        error_message.empty();

        // send request to server
         jQuery.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: {email: email.val().toLowerCase(), password: password.val(), remember: remember.prop('checked')},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async: true,
            timeout: 30000,
            dataType: 'json'
        }).done(function(responsedata){
            if(responsedata.login_ok){
                // redirect back to home page
                window.location.replace('/home');
            } else {
                // display error message
                $("<div>" + responsedata.error_msg + "</div>").appendTo(error_message);
            }
        });

    });
});

