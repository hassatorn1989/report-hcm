<?php

namespace App\Http\Controllers;

use App\Models\tbt_Time_Attendance;
use App\Models\tbt_Time_FlapGate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Excel;

class time_controller extends Controller
{
    public function time_flap_gate()
    {
        return view('time_flap_gate');
    }

    public function time_flap_gate_lists(Request $request)
    {
        $q = tbt_Time_FlapGate::selectRaw("EmpID, [DateTime], [Date], [Time], MachineNo, MachineType, InOut, IsError, IsInterface");
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('date_filter')) {
                    $datef = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_filter)));
                    $q->whereRaw("[DateTime] BETWEEN  FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd 08:15')  AND  CONVERT(varchar(20),''+' 08:14', 120) AND NOT([Date] ='{$datef}' AND InOut = 'I' AND IsError = 'Exception') OR ([Date] = FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd') AND InOut = 'I' AND IsError = 'Exception')");
                }
            })
            ->make();
    }

    public function time_attendance()
    {
        return view('time_attendance');
    }

    public function time_attendance_lists(Request $request)
    {
        $q = tbt_Time_Attendance::selectRaw("EmpID, [DateTime], [Date], [Time], MachineNo, MachineType, InOut, IsError, IsInterface");
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('date_filter')) {
                    $datef = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_filter)));
                    $q->whereRaw("[DateTime] BETWEEN  FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd 08:15')  AND  CONVERT(varchar(20),''+' 08:14', 120) AND NOT([Date] ='{$datef}' AND InOut = 'I' AND IsError = 'Exception') OR ([Date] = FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd') AND InOut = 'I' AND IsError = 'Exception')");
                }
            })
            ->make();
    }
}
