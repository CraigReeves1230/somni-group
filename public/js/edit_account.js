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


$(function () {

    // get form variables
    var form = $("#regform");
    var name = $("#name");
    var email = $("#email");
    var password = $("#password");
    var password_confirm = $("#password-confirm");
    var dob = $("#dob");
    var area_code = $("#area_code");
    var phone_number = $("#phone_number");
    var name_error = $("#name-error");
    var email_error = $("#email-error");
    var password_error = $("#password-error");
    var password_confirm_error = $("#password-confirm-error");
    var phone_number_error = $("#phone-number-error");
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
        if (password.val() !== '') {
            if (!reg_ex_password.test(password.val())) {
                $("<div>Password must be at least 7 characters and include 1 digit. No special characters or" + " spaces.</div>").appendTo(password_error);
                form_ok = false;
            }
        }

        // make sure password confirmation is formatted properly
        if (password.val() !== '') {
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

        // verify email
        if (form_ok) {
            jQuery.ajax({
                url: form.data("email-validate"),
                type: "POST",
                data: { email: email.val().toLowerCase() },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                async: true,
                timeout: 30000,
                dataType: 'json'
            }).done(function (dataresult) {
                if (dataresult.email_unique == false) {
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
                            password_confirmation: password_confirm.val(),
                            dob: dob.val(),
                            area_code: area_code.val(),
                            phone_number: phone_number.val()
                        },
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        async: true,
                        timeout: 30000,
                        dataType: 'json'
                    }).done(function (responsedata) {
                        // back to home
                        window.location.replace('/home');
                    });
                }
            });
        }
    });
});

/***/ })
/******/ ]);