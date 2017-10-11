$(function(){

    // get all variables
    const license_number = $("#license_number");
    const agent_type = $("#agent_type");
    const form = $("#agent_form");
    const license_number_error = $("#license-number-error");

    form.submit((event) => {
        let form_ok = true;
        event.preventDefault();

        if(license_number.val() === ''){
            form_ok = false;
            $("<div>License number is required.</div>").appendTo(license_number_error);
        }

        if(form_ok){
            jQuery.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    agent_type: agent_type.val(),
                    license_number: license_number.val()
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