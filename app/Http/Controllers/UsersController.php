<?php

namespace App\Http\Controllers;

use App\Services\Mailer;
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

    function __construct(TokenMaker $token_service){
        $this->token_service = $token_service;
    }

    // go to form to create a user
    function create(){
        return view('auth.register');
    }

    // save a user
    function save(Request $request){

        // validate request
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:7|confirmed',
            'checkbox' => 'required'
        ]);

        // create a new user
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => strtolower($request->email),
        ]);

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

    function login(Request $request){

        // find user
        if ($user = User::where('email', $request->email)->first() ) {
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

        if($user = User::where('email', $in_email)->first()) {

            // get data needed for sending information
            $reset_token = $token->create();
            $reset_link = route('password_reset_form', ['id' => $user->id, 'token' => $reset_token['key']]);

            // update reset digest for user as well as the reset digest timeout
            $user->reset_digest = $reset_token['key_encoded'];
            $user->reset_digest_timeout = Carbon::now()->addMinutes(15);
            $user->save();

            // send password reset email
            $mailer->send_mail('noreply@somnigroup.com', 'Somni Group', $user, 'Password Reset Request', 'email.password_reset',
                ['name' => $user->name, 'reset_link' => $reset_link]);
        }

        // return to homepage with flash message
        Session::flash('info', 'An email has been sent to your account with instructions on how to reset your password.');
        return redirect('/');
    }

    function password_reset_form($token, $id){

        if($user = User::find($id)) {
            if(Hash::check($token, $user->reset_digest)){
               if(Carbon::now() <= $user->reset_digest_timeout) {
                   return view('auth.passwords.reset', compact('token', 'user'));
               }
            }
        } else {
            // the link either has expired or invalid
            Session::flash('error', 'The reset link is invalid or has expired.');
            return redirect('/');
        }
    }

    function password_reset(Request $request, $token, $id){

        // validate info
        $this->validate($request, ['email' => 'required', 'password' => 'required|string|min:7|confirmed']);

        if($user = User::find($id)){
            if($user->email == strtolower($request->email)){
                if(Hash::check($token, $user->reset_digest)){
                    if(Carbon::now() <= $user->reset_digest_timeout) {

                        // reset password
                        $new_password = bcrypt($request->password);
                        $user->password = $new_password;

                        // erase the digest
                        $user->reset_digest = null;
                        $user->reset_digest_timeout = null;

                        $user->save();
                        Auth::login($user);
                        Session::flash('success', 'Your password has successfully been reset.');
                        return redirect('home');
                    }
                }
            }
        }
        Session::flash('error', 'The reset link is invalid, has expired, or an invalid email address was provided.');
        return redirect('/');
    }

}
