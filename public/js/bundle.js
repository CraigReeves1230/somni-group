/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(1);
__webpack_require__(2);
__webpack_require__(3);
__webpack_require__(4);
__webpack_require__(5);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

/* window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
} */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(function () {

    // get all variables
    var form = $("#form");
    var title = $("#title");
    var type = $("#type");
    var price = $("#price");
    var bedrooms = $("#bedrooms");
    var bathrooms = $("#bathrooms");
    var area = $("#area");
    var mls = $("#mls");
    var location = $("#location");
    var address = $("#address");
    var address_line_2 = $("#address_line_2");
    var city = $("#city");
    var state = $("#state");
    var zip = $("#zip");
    var description = $("#description");
    var feature = $("#feature");

    var title_error = $("#title-error");
    var price_error = $("#price-error");
    var bedrooms_error = $("#bedrooms-error");
    var bathrooms_error = $("#bathrooms-error");
    var area_error = $("#area-error");
    var mls_error = $("#mls-error");
    var address_error = $("#address-error");
    var city_error = $("#city-error");
    var state_error = $("#state-error");
    var zip_error = $("#zip-error");
    var geolocator_error = $("#geolocator-error");
    var error_messages = $(".error-message");

    var price_regex = /^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/; // numbers only. no currency sign
    var area_regex = /^[0-9]+$/; // numbers only

    form.submit(function (event) {

        event.preventDefault();
        var form_ok = true;
        error_messages.empty();

        if (title.val() == "") {
            form_ok = false;
            $("<div>Title is required</div>").appendTo(title_error);
        }

        if (!price_regex.test(price.val())) {
            form_ok = false;
            $("<div>Price must be a number. Do not include currency sign</div>").appendTo(price_error);
        }

        if (bedrooms.val() == '') {
            form_ok = false;
            $("<div>Bedrooms is required</div>").appendTo(bedrooms_error);
        }

        if (bathrooms.val() == '') {
            form_ok = false;
            $("<div>Bathrooms is required</div>").appendTo(bathrooms_error);
        }

        if (!area_regex.test(area.val())) {
            form_ok = false;
            $("<div>Area must be a number. No commas</div>").appendTo(area_error);
        }

        if (address.val() == '') {
            form_ok = false;
            $("<div>Address is required</div>").appendTo(address_error);
        }

        if (city.val() == '') {
            form_ok = false;
            $("<div>City is required</div>").appendTo(city_error);
        }

        if (state.val() == '') {
            form_ok = false;
            $("<div>State is required</div>").appendTo(state_error);
        }

        if (zip.val() == '') {
            form_ok = false;
            $("<div>ZIP Code is required</div>").appendTo(zip_error);
        }

        // submit form if all checks out
        if (form_ok) {
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
            }).done(function (responsedata) {
                if (responsedata.ok == true) {
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

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// handles user registration
$(function () {

    // get form variables
    var form = $("#form");
    var email = $("#email");
    var password = $("#password");
    var error_message = $("#error");
    var remember = $("#remember");

    // handle submission/errors
    form.on('submit', function (event) {

        // prevent submission until form is acceptable
        event.preventDefault();

        // empty out error messages
        error_message.empty();

        // send request to server
        jQuery.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: { email: email.val().toLowerCase(), password: password.val(), remember: remember.prop('checked') },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            async: true,
            timeout: 30000,
            dataType: 'json'
        }).done(function (responsedata) {
            if (responsedata.login_ok) {
                // redirect back to home page
                window.location.replace('/home');
            } else {
                // display error message
                $("<div>" + responsedata.error_msg + "</div>").appendTo(error_message);
            }
        });
    });
});

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(function () {

    // get variables
    var email = $("#email");
    var password = $("#password");
    var password_confirm = $("#password_confirm");
    var form = $("#form");
    var password_regex = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/;
    var password_error = $("#password_error");
    var email_error = $("#email_error");
    var error_messages = $(".error-message");
    var password_confirm_error = $("#password_confirm_error");

    form.submit(function (event) {
        event.preventDefault();
        error_messages.empty();
        var form_ok = true;

        if (!password_regex.test(password.val())) {
            $("<div>Password must be at least 7 characters and include 1 digit. No special characters or" + " spaces.</div>").appendTo(password_error);
            form_ok = false;
        }

        if (password.val() !== password_confirm.val()) {
            $("<div>Password and password confirmation do not match</div>").appendTo(password_error);
            form_ok = false;
        }

        // if form is ok, submit
        if (form_ok == true) {
            jQuery.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    password: password.val(),
                    email: email.val(),
                    password_confirmation: password_confirm.val()
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function (responsedata) {
                window.location.replace('/');
            });
        }
    });
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


// handles user registration
$(function () {

    // get form variables
    var form = $("#regform");
    var name = $("#name");
    var email = $("#email");
    var password = $("#password");
    var password_confirm = $("#password-confirm");
    var area_code = $("#area-code");
    var phone_number = $("#phone-number");
    var dob = $("#dob");
    var checkbox = $("#checkbox");
    var name_error = $("#name-error");
    var email_error = $("#email-error");
    var password_error = $("#password-error");
    var password_confirm_error = $("#password-confirm-error");
    var phone_number_error = $("#phone-number-error");
    var checkbox_error = $("#checkbox-error");
    var error_messages = $(".error-message");

    // regular expressions for validation
    var reg_ex_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; // proper email formatting
    var reg_ex_password = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/; // must contain at least 7 letters,
    // one number and one letter. No special characters or whitespace.

    // handle submission/errors
    form.on('submit', function (event) {

        // prevent submission until form is acceptable
        event.preventDefault();

        // empty out error messages
        error_messages.empty();

        // determine if form is ok with variable. By default it's true and is falsified if something is wrong
        // with the form
        var form_ok = true;

        // make sure name is acceptable
        if (name.val().length < 2) {
            // at least two characters
            $("<div>Name must be at least two characters</div>").appendTo(name_error);
            form_ok = false;
        }

        // make sure email is formatted properly
        if (!reg_ex_email.test(email.val())) {
            $("<div>Email must be properly formatted</div>").appendTo(email_error);
            form_ok = false;
        }

        // make sure password is formatted properly
        if (!reg_ex_password.test(password.val())) {
            $("<div>Password must be at least 7 characters and include 1 digit. No special characters or" + " spaces.</div>").appendTo(password_error);
            form_ok = false;
        }

        // make sure password confirmation is formatted properly
        if (password_confirm.val() !== password.val()) {
            $("<div>Password confirmation and Password do not match</div>").appendTo(password_confirm_error);
            form_ok = false;
        }

        // make sure area code exists
        if (area_code.val() == '') {
            $("<div>Phone number must have area code</div>").appendTo(phone_number_error);
            form_ok = false;
        }

        // make sure phone number exists
        if (phone_number.val() == '') {
            $("<div>Phone number is required</div>").appendTo(phone_number_error);
            form_ok = false;
        }

        // make sure that checkbox is checked
        if (!checkbox.prop('checked')) {
            $("<div>Checkbox must be checked</div>").appendTo(checkbox_error);
            form_ok = false;
        }

        // if form is ok check if email is unique. If so, submit the form and redirect
        if (form_ok) {
            $.ajax({
                url: form.data("email-validate"),
                type: "POST",
                data: { email: email.val().toLowerCase() },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function (responsedata) {
                var email_unique = responsedata.email_unique;
                if (email_unique == false) {
                    $("<div>An account with this email address already exists</div>").appendTo(email_error);
                } else {
                    $.ajax({
                        url: form.attr('action'),
                        type: "POST",
                        data: {
                            name: name.val(),
                            email: email.val(),
                            password: password.val(),
                            dob: dob.val(),
                            checkbox: checkbox.prop('checked'),
                            password_confirmation: password_confirm.val(),
                            area_code: area_code.val(),
                            phone_number: phone_number.val()
                        },
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        async: true,
                        timeout: 30000,
                        dataType: 'json'
                    }).done(function () {
                        // redirect back to home page
                        window.location.replace('/home');
                    });
                }
            });
        }
    });
});

/***/ })
/******/ ]);