<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class TranferDailyExport implements FromView
{
    protected $date_export_tranfer_daily;
    protected $date_post;
    protected $type_co;

    function __construct($date_export_tranfer_daily, $date_post, $type_co)
    {
        $this->date_export_tranfer_daily = $date_export_tranfer_daily;
        $this->date_post = $date_post;
        $this->type_co = $type_co;
    }
    public function view(): View
    {
        $datecut = explode(" - ", $this->date_export_tranfer_daily);
        $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        $datepost = date('Y-m-d', strtotime($this->date_post));
        $cond = '';
        if ($this->type_co == 'wtd') {
            $cond = "WHERE t.costCenter in  (SELECT costCenter FROM tbm_costCenter_co_wtd)";
        }
        $sql = "SELECT
        t.controllingArea,
        FORMAT(t.documentDate, 'yyyyMMdd')  as documentDate,
        FORMAT(t.posingDate, 'yyyyMMdd')  as posingDate,
        t.documentText,
        t.costCenter,
        t.skf,
        sum(t.amtHour) as quantity,
        t.text
        from(
        SELECT
        '1000' as controllingArea,
        t.transferDate as documentDate,
        t.transferDate as posingDate,
        CONCAT ( 'CO', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd')) as documentText,
        t.costCenter,
        'Z00025' as skf,
        t.amtHour,
        '' as text
        FROM
        dbo.tbc_JV_Transfer_daily AS t WHERE t.transferDate BETWEEN '{$datestart}' and '{$dateend}'
        union ALL
        SELECT
        '1000' as controllingArea,
        t.accrueDate as documentDate,
        FORMAT (CONVERT(datetime, '{$datepost}'), 'yyyyMMdd') as posingDate,
        CONCAT ( 'CO', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd')) as documentText,
        CONCAT(t.companyCode,t.costCenter),
        'Z00025' as skf,
        t.amtHour,
        '' as text
        FROM
        dbo.tbc_JV_Accrue_daily AS t WHERE t.accrueDate BETWEEN '{$datestart}' and '{$dateend}') as t
        {$cond}
        GROUP BY
        t.controllingArea,
        t.documentDate,
        t.posingDate,
        t.documentText,
        t.costCenter,
        t.skf,
        t.text";
        $data = DB::select($sql);
        return view('exports.accrue_daily_export', compact('data'));
    }
}
