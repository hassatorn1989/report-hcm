<?php

namespace App\Http\Controllers;

use App\Models\tb_user;
use Illuminate\Http\Request;

class dashboard_controller extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
