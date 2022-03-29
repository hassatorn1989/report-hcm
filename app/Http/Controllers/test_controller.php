<?php

namespace App\Http\Controllers;

use App\Models\tbm_PayPeriod;
use App\Models\view_user;
use Illuminate\Http\Request;
use DB;
class test_controller extends Controller
{
    public function index(Request $request)
    {
       echo date('Y-m-d', strtotime(' -1 day'));
    }
}
