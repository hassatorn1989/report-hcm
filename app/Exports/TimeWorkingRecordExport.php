<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class TimeWorkingRecordExport implements FromView
{
    protected $date_filter;

    function __construct($date_filter)
    {
        $this->date_filter = $date_filter;
    }
    public function view(): View
    {
        $date_filter = date('Y-m-d', strtotime(str_replace('/', '-', $this->date_filter)));
        $sql = "SELECT 1 AS 'SCO', EmpID AS 'SID',
                FORMAT([Date], 'yyyyMMdd') AS 'SDTE',
                FORMAT([Time], 'hhmm') AS 'STME',
                IIF(InOut = 'I', 'A', 'Q') AS 'SMNO',
                InOut AS 'STY', '' AS 'SFAG'
            FROM [dbo].[tbt_Time_Attendance]
            WHERE [DateTime] BETWEEN  FORMAT(DATEADD(DAY, -1, '{$date_filter}'), N'yyyy-MM-dd 08:15')  AND  CONVERT(varchar(20),'2022-04-28'+' 08:14', 120)
                AND NOT([Date] ='{$date_filter}' AND InOut = 'I' AND IsError = 'Exception')
                OR ([Date] = FORMAT(DATEADD(DAY, -1, '{$date_filter}'), N'yyyy-MM-dd') AND InOut = 'I' AND IsError = 'Exception')
            ORDER BY EmpID, [DateTime]";
        $data = DB::select($sql);
        return view('exports.time_working_record_export', compact('data'));

    }

}
