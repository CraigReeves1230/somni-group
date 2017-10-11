<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use Illuminate\Http\Request;

/// ********************************** ADMIN **************************************************************************
Route::group(['namespace' => 'admin', 'middlewareGroups' => 'web', 'middleware' => 'admin'], function() {

    Route::get('/admin/dashboard', 'DashboardController@index')->name('admin_dashboard');

    Route::get('/admin/listings/all', 'ListingsController@all_listings')->name('admin_all_listings');

    Route::get('/admin/listings/approved', 'ListingsController@approved_listings')->name('admin_approved_listings');

    Route::get('/admin/listings/pending', 'ListingsController@pending_listings')->name('admin_pending_listings');

    Route::get('/admin/listings/rejected', 'ListingsController@rejected_listings')->name('admin_rejected_listings');

    Route::get('/admin/listings/{id}/edit', 'ListingsController@edit')->name('admin_edit_listing');

    Route::post('/admin/listings/{id}/edit', 'ListingsController@update')->name('admin_edit_listing_go');

    Route::get('/admin/consultation/{listing_id}', 'ListingsController@new_consultation')->name('new_consultation');

    Route::post('/admin/consultation/{listing_id}', 'ListingsController@save_consultation')->name('save_consultation');

    Route::get('/admin/consultation/{listing_id}/edit', 'ListingsController@edit_consultation')->name('edit_consultation');

    Route::post('/admin/consultation/{listing_id}/edit', 'ListingsController@update_consultation')->name('update_consultation');

    Route::delete('/admin/consultation/{listing_id}', 'ListingsController@delete_consultation')->name('delete_consultation');

    Route::delete('/admin/listings/{id}', 'ListingsController@delete_listing')->name('admin_delete_listing');

});

/// ********************************** FRONT END **********************************************************************
Route::group(['namespace' => 'frontend', 'middlewareGroups' => 'web'], function() {

    // homepage route
    Route::get('/', function () {
        return view('frontend.home');
    })->name('index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/user/register', 'UsersController@create')->name('register_user')->middleware('guest');

    Route::post('/user/register', 'UsersController@save')->name('register_user')->middleware('guest');

    Route::get('/logout', 'UsersController@logout')->name('logout')->middleware('auth');

    Route::get('/login', 'UsersController@login_screen')->name('login')->middleware('guest');

    Route::post('/login', 'UsersController@login')->name('login_user')->middleware('guest');

    Route::get('/password_reset', 'UsersController@password_request')->name('password_reset')->middleware('guest');

    Route::post('/password_reset', 'UsersController@password_email')->name('password_reset')->middleware('guest');

    Route::get('/password_reset/do/{token}/{id}', 'UsersController@password_reset_form')->name('password_reset_form')
        ->middleware('guest');

    Route::post('/password_reset/do/{token}/{id}', 'UsersController@password_reset')->name('password_reset_do')
        ->middleware('guest');

    Route::post('/user/email_and_address_validate', 'UsersController@email_and_address_validate')->name('email_and_address_validate');

    Route::get('/listings/add_listing', 'ListingsController@create')->name('add_listing')->middleware('agent');

    Route::post('/listings/add_listing', 'ListingsController@store')->name('add_listing')->middleware('agent');

    Route::get('/listings/my_listings', 'ListingsController@my_listings')->name('my_listings')->middleware('agent');

    Route::get('/listings/my_listings/{id}/edit', 'ListingsController@edit')->name('edit_listing')->middleware('agent');

    Route::post('/listings/my_listings/{id}/update', 'ListingsController@update')->name('edit_listing_go')
        ->middleware('agent');

    Route::get('/listings/my_listings/{id}/photos/upload', 'ListingsController@add_photos')->name('listing_upload_photos')
        ->middleware('agent');

    Route::post('/listings/my_listings/{id}/photos/upload_go', 'ListingsController@save_photos')
        ->name('listing_upload_photos_go')->middleware('agent');

    Route::get('/listings/my_listings/{id}/photos/gallery', 'ListingsController@my_photos')
        ->name('my_photos')->middleware('agent');

    Route::post('/listings/my_listings/{listing_id}/photos/{image_id}/delete', 'ListingsController@delete_photo')
        ->name('delete_listing_photo')->middleware('agent');

    Route::post('/listings/my_listings/{listing_id}/photos/{image_id}/make_profile_pic', 'ListingsController@make_profile')
        ->name('make_profile')->middleware('agent');

    Route::get('/user/my_account/edit', 'UsersController@edit_account')->name('edit_account')->middleware('auth');

    Route::post('/user/my_account/update', 'UsersController@update_account')->name('update_account')->middleware('auth');

    Route::post('/user/my_account/update_email_and_address_validate', 'UsersController@update_email_and_address_validate')->name
    ('update_email_and_address_validate')
        ->middleware('auth');

    Route::post('/listings/search', 'ListingsController@search')->name('listings_search');

    Route::get('/listings/search/search_result/{search_query}&type={search_type}', 'ListingsController@search_results')
        ->name('search_results');

    Route::delete('/listings/{id}/delete', 'ListingsController@delete_listing')->name('delete_listing')->middleware('agent');

    Route::post('/listings/get_all_data', 'ListingsController@getAllDataFromListingResults')->name('get_data_from_listings');

    Route::get('/listings/all_listings/{search_type}', 'ListingsController@all_listings')->name('all_listings');

    Route::get('/users/admin/agent', 'UsersController@agent_edit')->name('agent_edit')->middleware('auth');

    Route::post('/users/admin/agent_signup_go', 'UsersController@agent_sign_up_go')->name('agent_sign_up_go')
        ->middleware('auth');

    Route::post('/users/admin/agent_edit_go', 'UsersController@agent_edit_go')->name('agent_edit_go')->middleware('agent');

});