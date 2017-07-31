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

Route::get('/', function () {
    return view('frontend.home');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/register', 'UsersController@create')->name('register_user')->middleware('guest');

Route::post('/user/register', 'UsersController@save')->name('register_user')->middleware('guest');

Route::get('/logout', 'UsersController@logout')->name('logout')->middleware('auth');

Route::get('/login', 'UsersController@login_screen')->name('login')->middleware('guest');

Route::post('/login', 'UsersController@login')->name('login')->middleware('guest');

Route::get('/password_reset', 'UsersController@password_request')->name('password_reset')->middleware('guest');

Route::post('/password_reset', 'UsersController@password_email')->name('password_reset')->middleware('guest');

Route::get('/password_reset/do/{token}/{id}', 'UsersController@password_reset_form')->name('password_reset_form')
    ->middleware('guest');

Route::post('/password_reset/do/{token}/{id}', 'UsersController@password_reset')->name('password_reset_do')
    ->middleware('guest');

Route::post('/email_validate', function(Request $request){
    if($request->ajax()){
        $test_email = $request->email;
        if(User::where('email', $test_email)->first()){
            $email_unique = false;
        } else {
            $email_unique = true;
        }
        return response()->json(['email_unique' => $email_unique]);
    }
})->name('email_validate');

