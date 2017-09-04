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

Route::group(['middlewareGroups' => 'web'], function() {

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

    Route::post('/user/email_validate', 'UsersController@email_validate')->name('email_validate');

    Route::get('/listings/add_listing', 'ListingsController@create')->name('add_listing')->middleware('auth');

    Route::post('/listings/add_listing', 'ListingsController@store')->name('add_listing')->middleware('auth');

    Route::get('/listings/my_listings', 'ListingsController@my_listings')->name('my_listings')->middleware('auth');

    Route::get('/listings/my_listings/{id}/edit', 'ListingsController@edit')->name('edit_listing')->middleware('auth');

    Route::post('/listings/my_listings/{id}/update', 'ListingsController@update')->name('edit_listing_go')
        ->middleware('auth');

    Route::get('/listings/my_listings/{id}/photos/upload', 'ListingsController@add_photos')->name('listing_upload_photos');

    Route::post('/listings/my_listings/{id}/photos/upload_go', 'ListingsController@save_photos')
        ->name('listing_upload_photos_go')->middleware('auth');

    Route::get('/listings/my_listings/{id}/photos/gallery', 'ListingsController@my_photos')
        ->name('my_photos')->middleware('auth');

    Route::post('/listings/my_listings/{listing_id}/photos/{image_id}/delete', 'ListingsController@delete_photo')
        ->name('delete_listing_photo')->middleware('auth');

    Route::post('/listings/my_listings/{listing_id}/photos/{image_id}/make_profile_pic', 'ListingsController@make_profile')
        ->name('make_profile')->middleware('auth');

    Route::get('/user/my_account/edit', 'UsersController@edit_account')->name('edit_account')->middleware('auth');

    Route::post('/user/my_account/update', 'UsersController@update_account')->name('update_account')->middleware('auth');

    Route::post('/user/my_account/update_email_validate', 'UsersController@update_email_validate')->name('update_email_validate')
        ->middleware('auth');

    Route::post('/listings/search', 'ListingsController@search')->name('listings_search');

    Route::get('/listings/search/search_result/{search_query}&type={search_type}', 'ListingsController@search_results')
        ->name('search_results');

    Route::delete('/listings/{id}/delete', 'ListingsController@delete_listing')->name('delete_listing')->middleware('auth');

    Route::post('/listings/get_all_data', 'ListingsController@getAllDataFromListingResults')->name('get_data_from_listings');

});