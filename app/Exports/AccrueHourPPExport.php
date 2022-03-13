<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class AccrueHourPPExport implements FromView
{
    protected $date_export;

    function __construct($date_export)
    {
        $this->date_export = $date_export;
    }
    public function view(): View
    {
        $dateexport = date('Y-m-d', strtotime(str_replace('/', '-', $this->date_export)));
        $sql = "SELECT
        t.costCenter,
        t.ActivityType,
        t.date_from,
        t.date_to,
        sum(t.amtHour) as amtHour
        from( SELECT
        t.costCenter,
        'Z002' as ActivityType,
        (t.transferDate) as date_from,
        (t.transferDate) as date_to,
        t.amtHour
        FROM
        dbo.tbc_JV_Transfer_daily AS t WHERE t.transferDate='{$dateexport}'
        UNION ALL
        SELECT
        t.costCenter,
        'Z002' as ActivityType,
        (t.accrueDate) as date_from,
        (t.accrueDate) as date_to,
        t.amtHour
        FROM
        dbo.tbc_JV_Accrue_daily AS t WHERE t.accrueDate='{$dateexport}') as t

        GROUP BY t.costCenter,
        t.ActivityType,t.date_from,t.date_to";
        $data = DB::select($sql);
        return view('exports.accrue_daily_export', compact('data'));
    }
}
