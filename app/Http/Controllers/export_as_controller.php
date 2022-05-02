<?php

namespace App\Http\Controllers;

use App\Exports\ManageTransferExport;
use App\Exports\TimeWorkingRecordExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class export_as_controller extends Controller
{
    public function manage_transfer()
    {
        return view('export_manage_transfer');
    }

    public function manage_transfer_lists()
    {
    }
    public function export_manage_transfer()
    {
        return Excel::download(new ManageTransferExport(), 'ManageTransfer-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function time_working_record()
    {
        return view('export_time_working_record');
    }

    public function time_working_record_lists(Request $request)
    {
        $datef = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_filter)));
        $sql = "SELECT 1 AS 'SCO', EmpID AS 'SID',
                FORMAT([Date], 'yyyyMMdd') AS 'SDTE',
                FORMAT([Time], 'hhmm') AS 'STME',
                IIF(InOut = 'I', 'A', 'Q') AS 'SMNO',
                InOut AS 'STY', '' AS 'SFAG'
            FROM [dbo].[tbt_Time_Attendance]
            WHERE [DateTime] BETWEEN  FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd 08:15')  AND  CONVERT(varchar(20),'2022-04-28'+' 08:14', 120)
                AND NOT([Date] ='{$datef}' AND InOut = 'I' AND IsError = 'Exception')
                OR ([Date] = FORMAT(DATEADD(DAY, -1, '{$datef}'), N'yyyy-MM-dd') AND InOut = 'I' AND IsError = 'Exception')
            ORDER BY EmpID, [DateTime]";
        $q = DB::select($sql);
        return DataTables::of($q)
            ->make();
    }
    public function export_time_working_record(Request $request)
    {
        return Excel::download(new TimeWorkingRecordExport($request->date_filter), 'TimeWorkingRecord-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
    }
}
