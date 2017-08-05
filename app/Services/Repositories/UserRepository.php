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
        // TODO: Implement update() method.
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