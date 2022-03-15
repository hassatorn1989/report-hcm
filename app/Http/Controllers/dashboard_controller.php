<?php

namespace App\Http\Controllers;

use App\Models\tb_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboard_controller extends Controller
{
    public function index()
    {
        $q1 = DB::selectOne("SELECT  count(t.dateIn) as qtyEmp from( SELECT t.dateIn FROM dbo.tbt_TimeWorking_hour AS t WHERE t.dateIn='" . date('Y-m-d') . "' GROUP BY t.empCode,t.dateIn) as t");
        $q2 = DB::selectOne("SELECT ({$q1->qtyEmp}*100/count(t.empCode)) as  qty FROM dbo.tbm_Employee AS t WHERE t.isActive='Y'");
        return view('dashboard', compact('q1', 'q2'));
    }
}
