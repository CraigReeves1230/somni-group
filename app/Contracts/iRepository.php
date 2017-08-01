<?php

namespace App\Contracts;


interface iRepository
{
    function store($data, $controller = null);

    function update($data, $controller = null);

    function save($saveable);

    function find($id);

    function find_by($criteria, $in_var);
}

