<?php
/**
 * Created by PhpStorm.
 * User: reeve
 * Date: 9/21/2017
 * Time: 6:04 PM
 */

namespace App\Services\Repositories;


use App\Appointment;
use App\Contracts\iRepository;

class AppointmentRepository implements iRepository
{

    function store($data, $controller = null)
    {
        // validations
        if($controller !== null){
            $controller->validate($data, [
                'date' => 'required', 'time' => 'required'
            ]);
        }

        // create new appointment
        $appointment = new Appointment([
            'date' => $data['date'],
            'time' => $data['time']
        ]);

        // save appointment
        $this->save($appointment);

        return $appointment;

    }

    function update($appointment, $data, $controller = null)
    {
        // validations
        if($controller !== null){
            $controller->validate($data, [
                'date' => 'required', 'time' => 'required'
            ]);
        }

        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->update();

        return $appointment;
    }

    function save($appointment)
    {
        $appointment->save();
    }

    function find($id)
    {
        // TODO: Implement find() method.
    }

    function find_by($criteria, $in_var)
    {
        return Appointment::where($criteria, $in_var)->first();
    }

    function where($criteria, $in_var, $paginate = false, $per_page = 10)
    {
        // TODO: Implement where() method.
    }

    function delete($appointment)
    {
        $appointment->delete();
    }
}