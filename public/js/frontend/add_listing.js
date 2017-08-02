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

        if (mls.val() == '') {
            form_ok = false;
            $("<div>MLS is required</div>").appendTo(mls_error);
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
                // redirect back to home page
                window.location.replace('/home');
            });
        }
    });
});

/***/ })
/******/ ]);