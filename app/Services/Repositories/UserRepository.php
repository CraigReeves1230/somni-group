<?php

namespace App\Services\Repositories;


use App\PhoneNumber;
use App\User;
use App\Contracts\iRepository;
use Carbon\Carbon;

class UserRepository implements iRepository
{

    function store($data, $controller = null)
    {
        if($controller != null){
            // validate request
            $controller->validate($data, [
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|confirmed|regex:/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/',
                'checkbox' => 'required',
                'area_code' => 'required',
                'phone_number' => 'required'
            ]);
        }

        // parse birthday but only if one was put in
        if($data->dob !== null) {
            $dob = Carbon::parse($data->dob);
        } else {
            $dob = null;
        }

        // create a new user
        $user = new User([
            'name' => $data->name,
            'password' => bcrypt($data->password),
            'email' => strtolower($data->email),
            'dob' => $dob
        ]);

        // clean up area code
        $area_code = str_replace('(', '', $data['area_code']);
        $area_code = str_replace(')', '', $area_code);
        $area_code = str_replace('-', '', $area_code);
        $area_code = str_replace(',', '', $area_code);

        // clean up phone number
        $phone = str_replace('(', '', $data['phone_number']);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace(',', '', $phone);

        $phone_number = PhoneNumber::create([
            'area_code' => $area_code,
            'number' => $phone
        ]);

        $user->phone_number()->associate($phone_number);

        // save user
        $this->save($user);

        return $user;
    }

    function update($user, $data, $controller = null)
    {
        if ($controller != null){
            $controller->validate($data, [
                'name' => 'required|string|min:2|max:255',
                'area_code' => 'required',
                'phone_number' => 'required'
            ]);

            // only if the email is changed should it be checked
            if($user->email != $data->email){
                $controller->validate($data, ['email' => 'required|string|email|max:255|unique:users']);
            }

            // if password was changed, check validation
            if($data->password != null){
                $controller->validate($data, ['password' => 'required|confirmed|regex:/(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{7,})$/']);
            }

        }

        // parse birthday, but only if one was actually put in
        if($data->dob !== null) {
            $dob = Carbon::parse($data->dob);
        } else {
            $dob = null;
        }

        // clean up area code
        $area_code = str_replace('(', '', $data['area_code']);
        $area_code = str_replace(')', '', $area_code);
        $area_code = str_replace('-', '', $area_code);
        $area_code = str_replace(',', '', $area_code);

        // clean up phone number
        $phone = str_replace('(', '', $data['phone_number']);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace(',', '', $phone);

        // update phone number
        $phone_number = $user->phone_number;
        $phone_number->area_code = $area_code;
        $phone_number->number = $phone;
        $phone_number->save();

        // update user
        $user->name = $data->name;
        $user->email = strtolower($data->email);
        $user->dob = $dob;

        if($data->password != null) {
            $user->password = bcrypt($data->password);
        }

        $this->save($user);
        return $user;
    }

    function save($user)
    {
        $user->save();
    }

    function find($id)
    {
        return User::find($id);
    }

    function find_by($criteria, $in_var)
    {
        return User::where($criteria, $in_var)->first();
    }

    function delete($user){
        $user->delete();
    }
}