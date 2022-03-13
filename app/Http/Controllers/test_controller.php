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
        $period = tbm_PayPeriod::where('year', '2021')
            ->where('period', '11')
            ->where('round', '1')
            ->first();
        $datestart = $period->periodStart;
        $dateend = $period->periodEnd;
        echo $sql = "SELECT *
        FROM
        view_trucker_period AS t
        WHERE drivingStart >= '{$datestart}' AND drivingEnd <= '{$dateend}'";
        $q = DB::select($sql);
        dd($q);
    }
}
