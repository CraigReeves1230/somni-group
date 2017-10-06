<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // index page for admin tool dashboard
    function index(){
        return view('admin.dashboard');
    }
}
