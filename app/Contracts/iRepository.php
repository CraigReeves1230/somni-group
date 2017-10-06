<?php

namespace App\Contracts;


interface iRepository
{
    function store($data, $controller = null);

    function update($updateable, $data, $controller = null);

    function save($saveable);

    function find($id);

    function find_by($criteria, $in_var);

    function where($criteria, $in_var, $paginate = false, $per_page = 10);

    function delete($deleteable);
}

