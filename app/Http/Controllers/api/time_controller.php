<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class time_controller extends Controller
{
    public function index(Request $request)
    {
        $sql = "SELECT
        t.orgCopCode,
        t.empCode,
        t.accountType,
        t.shiftType,
        t.dateIn,
        t.timeIn,
        t.dateOut,
        t.timeOut,
        t.workHour,
        e.orgDivCode,
        e.orgDepCode,
        e.orgJobCode
        FROM
        dbo.tbt_TimeWorking_hour AS t
        INNER JOIN dbo.tbm_Employee AS e ON t.orgCopCode = e.orgCopCode AND t.empCode = e.empCode
        WHERE t.dateIn = '{$request->dateIn}'";

        $q = DB::select($sql);
        if (!empty($q)) {
            $data = [
                'status' => true,
                'message' => "success",
                'data' => $q,
            ];
        } else {
            $data = [
                'status' => false,
                'message' => "Data Not Found!",
            ];
        }
        return response()->json($data);
    }
}
