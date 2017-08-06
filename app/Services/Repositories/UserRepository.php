<?php

namespace App\Services\Repositories;


use App\User;
use App\Contracts\iRepository;

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
                'checkbox' => 'required'
            ]);
        }

        // create a new user
        $user = new User([
            'name' => $data->name,
            'password' => bcrypt($data->password),
            'email' => strtolower($data->email),
        ]);

        // save user
        $this->save($user);

        return $user;
    }

    function update($user, $data, $controller = null)
    {
        if ($controller != null){
            $controller->validate($data, [
                'name' => 'required|string|min:2|max:255'
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

        // update user
        $user->name = $data->name;
        $user->email = strtolower($data->email);

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