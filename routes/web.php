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

});