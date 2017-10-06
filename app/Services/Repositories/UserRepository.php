<?php

namespace App\Services\Repositories;


use App\PhoneNumber;
use App\User;
use App\Contracts\iRepository;
use Carbon\Carbon;

class UserRepository implements iRepository
{
    private $address_repository;

    function __construct(AddressRepository $address_repository){
        $this->address_repository = $address_repository;
    }

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
        if($data['dob'] !== null) {
            $dob = Carbon::parse($data->dob);
        } else {
            $dob = null;
        }

        // create a new user
        $user = new User([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'email' => strtolower($data['email']),
            'dob' => $dob
        ]);

        // create address for user if one was entered
        if($data['address_line_1'] !== null || $data['address_line_2'] !== null || $data['city'] !== null ||
            $data['zip'] !== null){
            if($address = $this->address_repository->store($data, $this)) {
                $user->address()->associate($address);
            }
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
        if($data['dob'] !== null) {
            $dob = Carbon::parse($data['dob']);
        } else {
            $dob = null;
        }

        // update address for user if one was entered already
        if($data['address_line_1'] !== null || $data['address_line_2'] !== null || $data['city'] !== null ||
            $data['zip'] !== null){
            // update address if it is already there
            if($user->address !== null) {
                $address = $user->address;
                $this->address_repository->update($address, $data, $this);
            } else {
                // create new address if there isn't one there
                if($address = $this->address_repository->store($data, $this)){
                    $user->address()->associate($address);
                }
            }
        } else {
            // if user had an address, delete it since the user no longer wants their address listed
            $this->address_repository->delete($user->address);
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
        $phone_number->update();

        // update user
        $user->name = $data['name'];
        $user->email = strtolower($data['email']);
        $user->dob = $dob;

        if($data['password'] != null) {
            $user->password = bcrypt($data['password']);
        }

        $user->update();
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

    function where($criteria, $in_var, $paginate = true, $per_page = 10){
        if($paginate){
            $ret_val = User::where($criteria, $in_var)->paginate($per_page);
        } else {
            $ret_val = User::where($criteria, $in_var)->get();
        }

        return $ret_val;
    }

    function delete($user){
        $user->delete();
    }
}