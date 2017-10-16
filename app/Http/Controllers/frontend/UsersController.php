<?php

namespace App\Http\Controllers\frontend;

use App\Address;
use App\Services\GeoLocator;
use App\Services\Mailer;
use App\Services\Repositories\AddressRepository;
use App\Services\Repositories\UserRepository;
use App\Services\SearchIndex;
use App\Services\TokenMaker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $token_service;
    private $user_repository;
    private $address_repository;
    private $search_index;
    private $geolocator;

    function __construct(TokenMaker $token_service, UserRepository $user_repository, AddressRepository
    $address_repository, GeoLocator $geolocator, SearchIndex $search_index){
        $this->token_service = $token_service;
        $this->user_repository = $user_repository;
        $this->address_repository = $address_repository;
        $this->geolocator = $geolocator;
        $this->search_index = $search_index;
    }

    // go to form to create a user
    function create(){
        return view('auth.register');
    }

    // save a user
    function save(Request $request){

        // create user
        $user = $this->user_repository->store($request, $this);

        // log user in
        Auth::login($user);

        // return and redirect back to home
        if($request->ajax()){
            return response()->json(['name' => $user->name,
                'password' => $user->password,
                'email' => $user->email, 'home_url' => route('home')]);
        } else {
            return redirect('/home');
        }
    }

    // validates address to see if it is a real address
    function validate_address($request){

        // get geolocator
        $geo = $this->geolocator;

        // by default, is_real is true
        $is_real = true;
        $address = null;

        // we only want to test the address if one was put in...
        if($request['address_line_1'] !== null || $request['address_line_2'] !== null || $request['city'] !== null ||
            $request['zip'] !== null) {

            // convert address into string
            $address_string = "{$request['address_line_1']} {$request['city']} {$request['state']} {$request['zip']}";

            $is_real = $geo->convert($address_string) ? true : false;
        }

        return $is_real;
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }

    function login_screen(){
        return view('auth.login');
    }

    function email_and_address_validate(Request $request){
        if($request->ajax()){
            $test_email = strtolower($request->email);
            if($this->user_repository->find_by('email', $test_email)){
                $email_unique = false;
            } else {
                $email_unique = true;
            }

            // also check to see if address is a real address
            $real_address = $this->validate_address($request);

            return response()->json(['email_unique' => $email_unique, 'real_address' => $real_address]);
        }
    }

    function update_email_and_address_validate(Request $request){
        if($request->ajax()){
            $test_email = strtolower($request->email);
            $user = Auth::user();

            // if email is unchanged, we know that it is unique
            if($test_email == $user->email){
                $email_unique = true;
            } else {
                // test uniqueness of email if email has been changed
                if ($this->user_repository->find_by('email', $test_email)) {
                    $email_unique = false;
                } else {
                    $email_unique = true;
                }
            }

            // also check to see if address is a real address
            $real_address = $this->validate_address($request);

            return response()->json(['email_unique' => $email_unique, 'real_address' => $real_address]);
        }
    }

    function login(Request $request){

        // get the email
        $email = strtolower($request->email);

        // find user
        if ($user = $this->user_repository->find_by('email', $email)) {
            if(Hash::check($request->password, $user->password)) {

                // log user in...
                if($request->remember == true) {
                    Auth::login($user, true);
                } else {
                    Auth::login($user, false);
                }

                $login_ok = true;
                $error_msg = null;
            } else {
                $login_ok = false;
                $error_msg = 'The username or password is incorrect';
            }
        } else {
            $login_ok = false;
            $error_msg = 'The username or password is incorrect';
        }
        // return to home
        if($request->ajax()){
            return response()->json([
                'login_ok' => $login_ok, 'error_msg' => $error_msg, 'redirect' => route('home')
            ]);
        } else {
            if($login_ok) {
                return redirect('/home');
            } else {
                return redirect()->back();
            }
        }
    }

    function password_request(){
        return view('auth.passwords.email');
    }

    function password_email(Request $request, TokenMaker $token, Mailer $mailer){

        // find user by email
        $in_email = strtolower($request->email);

        if($user = $this->user_repository->find_by('email', $in_email)) {

            // get data needed for sending information
            $reset_token = $token->create();
            $reset_link = route('password_reset_form', ['id' => $user->id, 'token' => $reset_token['key']]);

            // update reset digest for user as well as the reset digest timeout
            $user->reset_digest = $reset_token['key_encoded'];
            $user->reset_digest_timeout = Carbon::now()->addMinutes(15);
            $this->user_repository->save($user);

            // send password reset email
            $mailer->send_mail('noreply@somnigroup.com', 'Somni Group', $user, 'Password Reset Request', 'email.password_reset',
                ['name' => $user->name, 'reset_link' => $reset_link]);
        }

        // return to homepage with flash message
        Session::flash('info', 'An email has not been sent to your account with instructions on how to reset your password.');
        return redirect('/');
    }

    function password_reset_form($token, $id){

        if($user = $this->user_repository->find($id)) {
            if(Hash::check($token, $user->reset_digest)){
               if(Carbon::now() <= $user->reset_digest_timeout) {
                   return view('auth.passwords.reset', compact('token', 'user'));
               }
            }
        }

        // the link either has expired or is invalid
        Session::flash('error', 'The reset link is invalid or has expired.');
        return redirect('/');
    }

    function password_reset(Request $request, $token, $id){

        // validate info
        $this->validate($request, ['email' => 'required',
            'password' => 'required|confirmed|regex:/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/']);

        if($user = $this->user_repository->find($id)){
            if($user->email == strtolower($request->email)){
                if(Hash::check($token, $user->reset_digest)){
                    if(Carbon::now() <= $user->reset_digest_timeout) {

                        // reset password
                        $new_password = bcrypt($request->password);
                        $user->password = $new_password;

                        // erase the digest
                        $user->reset_digest = null;
                        $user->reset_digest_timeout = null;

                        $this->user_repository->save($user);
                        Auth::login($user);
                        Session::flash('success', 'Your password has successfully been reset.');

                        if($request->ajax()){
                            return response()->json(['ok' => true]);
                        } else {
                            return redirect('home');
                        }
                    }
                }
            }
        }

        Session::flash('error', 'The reset link is invalid, has expired, or an invalid email address was provided.');

        if($request->ajax()){
            return response()->json(['ok' => false]);
        } else {
            return redirect('/');
        }
    }

    function edit_account(){

        // get user
        $user = Auth::user();

        // get the user's address
        if($user->address !== null) {
            $address = $user->address;
        } else {
            $address = new Address();
        }

        // make phone number pretty
        $phone_number = $user->phone_number->number;
        $phone_number = substr_replace($phone_number, '-', 3, 0);

        return view('frontend.user.edit_user', compact('user', 'phone_number', 'address'));
    }

    function update_account(Request $request){
        $user = Auth::user();
        if ($user = $this->user_repository->update($user, $request, $this)){

            Session::flash('success', 'Your account has been updated.');
            if($request->ajax()){
                return response()->json(['ok' => true]);
            } else {
                return redirect('/');
            }
        } else {
            Session::flash('error', 'There was an error in updating your account.');
            if($request->ajax()){
                return response()->json(['ok' => false]);
            } else {
                return redirect('/');
            }
        }

    }

    function agent_edit(){
        $user = Auth::user();

        // get user address info
        if(!is_null($user->address)){
            $address_line_1 = $user->address->line_1;
            $address_line_2 = $user->address->line_2;
            $city = $user->address->city;
            $state = $user->address->state;
            $zip = $user->address->zip;
        } else {
            $address_line_1 = '';
            $address_line_2 = '';
            $city = '';
            $state = '';
            $zip = '';
        }

        return view('frontend.user.agent.edit_agent',
            compact('user', 'address_line_1', 'address_line_2', 'city', 'state', 'zip'));
    }

    function agent_sign_up_go(Request $request){

        $user = Auth::user();
        $user->agent = true;
        $user->agent_type = $request->agent_type;
        $user->license_number = $request->license_number;

        // save address
        $address = $this->address_repository->store($request, $this);
        $user->address()->associate($address);

        // save user and update search index
        $this->user_repository->save($user);
        $this->search_index->add_agent($user);

        Session::flash('success', 'You have signed up as an agent. You may now add and edit property listings.');
        if($request->ajax()){
            return response()->json(['ok' => true]);
        } else {
            return redirect('/');
        }
    }

    function agent_edit_go(Request $request){

        $user = Auth::user();
        $user->agent_type = $request->agent_type;
        $user->license_number = $request->license_number;

        // update the address and search index
        $this->address_repository->update($user->address, $request, $this);
        $user->update();
        $this->search_index->update_agent($user);

        if($request->ajax()){
            return response()->json(['ok' => true]);
        } else {
            return redirect('/');
        }
    }

}
