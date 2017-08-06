<?php

namespace App\Http\Controllers;

use App\Services\Mailer;
use App\Services\Repositories\UserRepository;
use App\Services\TokenMaker;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    private $token_service;
    private $user_repository;

    function __construct(TokenMaker $token_service, UserRepository $user_repository){
        $this->token_service = $token_service;
        $this->user_repository = $user_repository;
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

    function logout(){
        Auth::logout();
        return redirect('/');
    }

    function login_screen(){
        return view('auth.login');
    }

    function email_validate(Request $request){
        if($request->ajax()){
            $test_email = strtolower($request->email);
            if($this->user_repository->find_by('email', $test_email)){
                $email_unique = false;
            } else {
                $email_unique = true;
            }
            return response()->json(['email_unique' => $email_unique]);
        }
    }

    function update_email_validate(Request $request){
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
            return response()->json(['email_unique' => $email_unique]);
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
        return view('frontend.user.edit_user', compact('user'));
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
}
