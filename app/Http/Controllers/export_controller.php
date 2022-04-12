<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\AccrueDailyExport;
use App\Exports\ManhourExport;
use App\Exports\TranferDailyExport;
use App\Exports\TruckerPeriodExport;
use App\Models\tb_log;
use App\Models\tb_menu;
use App\Models\tbm_PayPeriod;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class export_controller extends Controller
{
    public function manhour_period()
    {
        $year = tbm_PayPeriod::selectRaw("DISTINCT(year) as year")->orderBy('year', 'desc')->get();
        $period = tbm_PayPeriod::selectRaw("DISTINCT(period) as period")->orderBy('period', 'asc')->get();
        $round = tbm_PayPeriod::selectRaw("DISTINCT(round) as round")->orderBy('round', 'asc')->get();
        return view('export_manhour_period', compact('year', 'period', 'round'));
    }

    public function manhour_period_lists(Request $request)
    {
        if (!empty($request->filter_year) && !empty($request->filter_period) && !empty($request->filter_round)) {
            $period = tbm_PayPeriod::where('year', $request->filter_year)
                ->where('period', $request->filter_period)
                ->where('round', $request->filter_round)
                ->first();
            // $datecut = explode(" - ", $request->date_export_tranfer_daily);
            // $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
            $datestart = $period->periodStart;
            // $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
            $dateend = $period->periodEnd;
        } else {
            $datestart = date('Y-m-d');
            $dateend = date('Y-m-d');
        }
        $datepost = (!empty($request->date_post)) ? date('Y-m-d', strtotime(str_replace('/', '-', $request->date_post))) : date('Y-m-d');
        // ROW_NUMBER() OVER (ORDER BY  t.companyCode ASC)
        // $sql = "SELECT
        // '1' AS NO,
        // t.companyCode as BUKRS,
        //  CONCAT ( 'JVM', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd') ) AS XBLNR,
        // 'PL' AS BLART,
        // CONCAT ( FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyyyMMdd') ) AS BKTXT,
        // FORMAT (t.tdate, 'dd.MM.yyyy') as BLDAT,
        // FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,    /* get from Post Date*/
        // t.accountCode as SAKNR,
        //  'THB' as WAERS,
        // t.amtWage as WRBTR,
        // t.ioNumber as AUFNR,
        // t.costCenter as KOSTL,
        // t.amtHour as  ZUONR,
        //  t.jvReferance as SGTXT,
        // '' as MATNR,
        // 'H' as MEINS,
        // t.amtHour as MENGE,
        // '0001' as BUPLA
        // from (
        // SELECT
        // t.transferDate as tdate,
        // '1800' as companyCode,
        // t.costCenter,
        // t.accountCode,
        // t.ioNumber,
        // t.amtWage,
        // t.amtHour,
        // t.jvReferance
        // FROM
        // dbo.tbc_JV_Transfer_daily AS t
        // WHERE t.transferDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y'
        // UNION ALL
        // SELECT
        // t.accrueDate  as tdate,
        // '1800' as companyCode,
        // t.costCenter,
        // t.accountCode,
        // t.ioNumber,
        // t.amtWage,
        // t.amtHour,
        // '' as jvReferance
        // FROM
        // dbo.tbc_JV_Accrue_daily AS t
        // WHERE t.accrueDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y') as t";
        $sql = "SELECT
        '1' AS NO,
        t.companyCode as BUKRS,
        CONCAT ( 'JVM', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd') ) AS XBLNR,
		'PL' AS BLART,
		CONCAT ( FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyyyMMdd') ) AS BKTXT,
        FORMAT (t.tdate, 'dd.MM.yyyy') as BLDAT,
        FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,
        '' as LDGRP,
        '' as MONAT,
        '' as VALUT,
        '' as KURSF,
        '' as XREF1_HD,
        '' as XREF2_HD,
        '' as XNEG,
        '' as BSCHL,
        t.accountCode as SAKNR,
        '' as LIFNR,
        '' as KUNNR,
        '' as UMSKZ,
        '' as LOKKT,
        'THB' as WAERS,
        t.amtWage as WRBTR,
        '' as DMBTR,
        '' as DMBE2,
        '' as SHKZG,
        '' as RCOMP,
        '' as BEWAR,
        '' as PS_POSID,
        t.ioNumber as AUFNR,
        t.costCenter as KOSTL,
        '' as PRCTR,
        '' as PPRCT,
        '' as KKBER,
        '' as FILKD,
        '0001' as BUPLA,
        '' as SECCO,
        '' as LSTAR,
        '' as FKBER,
        '' as ZZONE,
        '' as MWSKZ,
        '' as WMWST,
        '' as MWSTS,
        '' as FWBAS,
        '' as HWBAS,
        '' as WITHT,
        '' as WT_WITHCD,
        '' as WT_QSSHH,
        '' as WT_QSSHB,
        '' as WT_QSSH2,
        '' as WT_QBSHH,
        '' as WT_QBSHH_DC,
        '' as WT_QBSH2,
        '' as ZFBDT,
        '' as ZTERM,
        '' as ZBD1T,
        '' as ZBD2T,
        '' as ZBD3T,
        '' as ZBD1P,
        '' as ZBD2P,
        '' as SKFBT,
        '' as SKNTO,
        '' as HBKID,
        '' as HKTID,
        '' as BVTYP,
        '' as ZLSCH,
        '' as UZAWE,
        '' as ZLSPR,
        '' as DTWS1,
        '' as DTWS2,
        '' as DTWS3,
        '' as DTWS4,
        '' as INVFO_PYCUR,
        '' as INVFO_PYAMT,
        '' as ALT_PAYEE,
        '' as ALT_PAYEE_BANK,
        '' as KIDNO,
        '' as  ZUONR,
        t.jvReferance as SGTXT,
        '' as MATNR,
        'H' as MEINS,
        t.amtHour as MENGE,
        '' as XREF1,
        '' as XREF2,
        '' as XREF3,
        '' as KNDNR,
        '' as VTWEG,
        '' as SPART,
        '' as WERKS,
        '' as ARTNR,
        '' as PRCTR1,
        '' as VKORG,
        '' as SEGMENT,
        '' as KUNRE,
        '' as KUNWE,
        '' as KUNRG,
        '' as PRDHA,
        '' as PAPH1,
        '' as PAPH2,
        '' as PAPH3,
        '' as PAPH4,
        '' as PAPH5,
        '' as PAPH6,
        '' as PAPH7,
        '' as PAPH8,
        '' as MTART,
        '' as MATKL,
        '' as MVGR1,
        '' as MVGR2,
        '' as MVGR3,
        '' as KDGRP,
        '' as KVGR1,
        '' as KVGR2,
        '' as KVGR3,
        '' as KVGR4,
        '' as REGIO,
        '' as VKGRP,
        '' as VKBUR,
        '' as WW001,
        '' as AUART,
        '' as CHARG,
        '' as KMLAND,
        '' as VBUND,
        '' as ZEIFO,
        '' as KDAUF,
        '' as KDPOS,
        '' as WW003_PA
        from (
        SELECT
        t.transferDate as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        t.jvReferance
        FROM
        dbo.tbc_JV_Transfer_daily AS t
        WHERE t.transferDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y'
        UNION ALL
        SELECT
        t.payrollDate  as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        '' as jvReferance
        FROM
        dbo.tbc_JV_Payroll_period AS t
        WHERE t.payrollDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y') as t";
        $q = DB::select($sql);
        return DataTables::of($q)
            ->addColumn('SHKZG', function ($q) {
                return (substr($q->WRBTR, 0, 1) == '-') ? 'H' : 'S';
            })
            ->make();
    }


    public function export_manhour_period(Request $request)
    {
        $period = tbm_PayPeriod::where('year', $request->filter_year)
            ->where('period', $request->filter_period)
            ->where('round', $request->filter_round)
            ->first();
        DB::beginTransaction();
        try {
            $menu = tb_menu::where('menu_link', 'export/manhour-period',)->first();
            $log_description = 'Year = ' .  $request->filter_year;
            $log_description .= ', Period = ' . $request->filter_period;
            $log_description .= ', Round = ' . $request->filter_round;
            $log_description .= ', Date Post = ' . $request->date_post;

            $q = new tb_log();
            $q->log_datetime = Carbon::now();
            $q->log_description = $log_description;
            $q->menu_id = $menu->id;
            $q->user_id = Auth::user()->idx;
            $q->save();
            DB::commit();
            return Excel::download(new ManhourExport($period, $request->date_post), 'ManhourPeriod-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function trucker_period()
    {
        $year = tbm_PayPeriod::selectRaw("DISTINCT(year) as year")->orderBy('year', 'desc')->get();
        $period = tbm_PayPeriod::selectRaw("DISTINCT(period) as period")->orderBy('period', 'asc')->get();
        $round = tbm_PayPeriod::selectRaw("DISTINCT(round) as round")->orderBy('round', 'asc')->get();
        return view('export_trucker_period', compact('year', 'period', 'round'));
    }

    public function trucker_period_lists(Request $request)
    {
        if (!empty($request->filter_year) && !empty($request->filter_period) && !empty($request->filter_round)) {
            $period = tbm_PayPeriod::where('year', $request->filter_year)
                ->where('period', $request->filter_period)
                ->where('round', $request->filter_round)
                ->first();
            $datestart = $period->periodStart;
            $dateend = $period->periodEnd;
        } else {
            $datestart = date('Y-m-d');
            $dateend = date('Y-m-d');
        }

        $sql = "SELECT *
        FROM
        view_trucker_period AS t
        WHERE drivingStart >= '{$datestart}' AND drivingEnd <= '{$dateend}'";
        $q = DB::select($sql);
        return DataTables::of($q)
            ->addColumn('BUDAT', function ($q) use ($request) {
                return (!empty($request->date_post)) ? date('d.m.Y', strtotime(str_replace('/', '-', $request->date_post))) : date('d.m.Y');
            })
            ->make();
    }

    public function export_trucker_period(Request $request)
    {
        DB::beginTransaction();
        try {

            $period = tbm_PayPeriod::where('year', $request->filter_year)
            ->where('period', $request->filter_period)
            ->where('round', $request->filter_round)
            ->first();


            $menu = tb_menu::where('menu_link', 'export/trucker-period')->first();
            $log_description = 'Year = ' .  $request->filter_year;
            $log_description .= ', Period = ' . $request->filter_period;
            $log_description .= ', Round = ' . $request->filter_round;
            $log_description .= ', Date Post = ' . $request->date_post;

            $q = new tb_log();
            $q->log_datetime = Carbon::now();
            $q->log_description = $log_description;
            $q->menu_id = $menu->id;
            $q->user_id = Auth::user()->idx;
            $q->save();
            DB::commit();


            return Excel::download(new TruckerPeriodExport($period, $request->date_post), 'TruckePeriod-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }

    }

    public function accrue_daily()
    {
        return view('export_accrue_daily');
    }

    public function accrue_daily_lists(Request $request)
    {
        if (!empty($request->date_export_accrue_daily)) {
            $datecut = explode(" - ", $request->date_export_accrue_daily);
            $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
            $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        } else {
            $datestart = date('Y-m-d');
            $dateend = date('Y-m-d');
        }
        $datepost = (!empty($request->date_post)) ? date('Y-m-d', strtotime(str_replace('/', '-', $request->date_post))) : date('Y-m-d');
        // ROW_NUMBER() OVER (ORDER BY  t.companyCode ASC)
        $sql = "SELECT
        '1' AS NO,
        t.companyCode as BUKRS,
        CONCAT ( 'JVA', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd') ) AS XBLNR,
		'PL' AS BLART,
		CONCAT ( FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyyyMMdd') ) AS BKTXT,
        FORMAT (t.tdate, 'dd.MM.yyyy') as BLDAT,
        FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,    /* get from Post Date*/
        t.accountCode as SAKNR,
         'THB' as WAERS,
        t.amtWage as WRBTR,
        t.ioNumber as AUFNR,
        t.costCenter as KOSTL,
        t.amtHour as  ZUONR,
         t.jvReferance as SGTXT,
        '' as MATNR,
        'H' as MEINS,
        t.amtHour as MENGE,
        '0001' as BUPLA
        from (
        SELECT
        t.transferDate as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        t.jvReferance
        FROM
        dbo.tbc_JV_Transfer_daily AS t
        WHERE t.transferDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y'
        UNION ALL
        SELECT
        t.accrueDate  as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        '' as jvReferance
        FROM
        dbo.tbc_JV_Accrue_daily AS t
        WHERE t.accrueDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y') as t";
        $q = DB::select($sql);
        return DataTables::of($q)
            ->addColumn('SHKZG', function ($q) {
                return (substr($q->WRBTR, 0, 1) == '-') ? 'H' : 'S';
            })
            ->make();
    }

    public function export_accrue_daily(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = tb_menu::where('menu_link', 'export/accrue-daily')->first();
            $log_description = 'Date Range = ' . $request->date_export_accrue_daily;
            $log_description .= ', Date Post = ' . $request->date_post;
            $q = new tb_log();
            $q->log_datetime = Carbon::now();
            $q->log_description = $log_description;
            $q->menu_id = $menu->id;
            $q->user_id = Auth::user()->idx;
            $q->save();
            DB::commit();
            return Excel::download(new AccrueDailyExport($request->date_export_accrue_daily, $request->date_post), 'AccrueDailyExport-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
        // return Excel::download(new AccrueDailyExport($request->date_export_accrue_daily, $request->date_post), 'AccrueDailyExport-'.date('YmdHis').'.csv', \Maatwebsite\Excel\Excel::CSV);

    }

    public function accrue_hour_pp()
    {
        return view('export_accrue_hour_pp');
    }

    public function accrue_hour_pp_lists(Request $request)
    {
        if (!empty($request->date_export)) {
            $dateexport = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_export)));
        } else {
            $dateexport = date('Y-m-d');
        }
        $sql = "SELECT
        t.costCenter,
        t.ActivityType,
         FORMAT (CONVERT(datetime, t.date_from), 'dd.MM.yyyy') as date_from,
        FORMAT (CONVERT(datetime, t.date_to), 'dd.MM.yyyy') as date_to,
        '' as Flag,
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
        WHERE  (t.costCenter between '1800A93001' AND '1800A94000' )
        or  (t.costCenter between '1800A4421' AND '1800A95400' )
        or  (t.costCenter between '1800A95852' AND '1800A95900' )

        GROUP BY t.costCenter,
        t.ActivityType,t.date_from,t.date_to";
        $q = DB::select($sql);
        return DataTables::of($q)->make();
    }

    public function export_accrue_hour_pp(Request $request)
    {
        $dateexport = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_export)));


        DB::beginTransaction();
        try {
            $menu = tb_menu::where('menu_link', 'export/accrue-hour-pp')->first();
            $log_description = 'Date = ' . $request->date_export;
            $q = new tb_log();
            $q->log_datetime = Carbon::now();
            $q->log_description = $log_description;
            $q->menu_id = $menu->id;
            $q->user_id = Auth::user()->idx;
            $q->save();
            DB::commit();

            $sql = "SELECT
        t.costCenter,
        t.ActivityType,
        FORMAT (CONVERT(datetime, t.date_from), 'dd.MM.yyyy') as date_from,
        FORMAT (CONVERT(datetime, t.date_to), 'dd.MM.yyyy') as date_to,
        '' as Flag,
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
           WHERE  (t.costCenter between '1800A93001' AND '1800A94000' )
        or  (t.costCenter between '1800A4421' AND '1800A95400' )
        or  (t.costCenter between '1800A95852' AND '1800A95900' )
        GROUP BY t.costCenter,
        t.ActivityType,t.date_from,t.date_to";
            $data = DB::select($sql);

            $content = "Cost Center\t";
            $content .= "Actity Type\t";
            $content .= "Date From\t";
            $content .= "Date to\t";
            $content .= "Flag\t";
            $content .= "Quantity\n";
            // $content .= "\n";
            foreach ($data as $row) {
                $content .= $row->costCenter . "\t";
                $content .= $row->ActivityType . "\t";
                $content .= $row->date_from . "\t";
                $content .= $row->date_to . "\t";
                $content .= $row->Flag . "\t";
                $content .= $row->amtHour . "\n";

                // $content .= "\n";
            }
            $prefixeDate = date('dmY', strtotime(str_replace('/', '-', $request->date_export)));
            $fileName = 'ActualHr PP' . $prefixeDate . '.txt';
            $headers = [
                'Content-type' => 'text/plain',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            ];

            return response()->make($content, 200, $headers);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function accrue_hour_co()
    {
        return view('export_accrue_hour_co');
    }

    public function accrue_hour_co_lists(Request $request)
    {
        $datecut = explode(" - ", $request->date_export);
        $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        $datepost = date('Y-m-d', strtotime($request->date_post));
        $cond = '';

        DB::beginTransaction();
        try {
            $menu = tb_menu::where('menu_link', 'export/accrue-hour-co')->first();
            $log_description = 'Date Range = ' . $request->date_export;
            $q = new tb_log();
            $q->log_datetime = Carbon::now();
            $q->log_description = $log_description;
            $q->menu_id = $menu->id;
            $q->user_id = Auth::user()->idx;
            $q->save();
            DB::commit();

            if ($request->co_type == 'wtd') {
                $cond = "WHERE t.costCenter in (SELECT costCenter FROM tbm_costCenter_co_wtd)";
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
        t.costCenter,
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
            $q = DB::select($sql);
            return DataTables::of($q)->make();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function export_accrue_hour_co(Request $request)
    {
        $datecut = explode(" - ", $request->date_export);
        $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        // $datepost = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_post)));
        $cond = '';
        if ($request->co_type == 'wtd') {
            $cond = "WHERE t.costCenter in (SELECT costCenter FROM tbm_costCenter_co_wtd)";
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
        FORMAT (CONVERT(datetime, '{$dateend}'), 'yyyyMMdd') as posingDate,
        CONCAT ( 'CO', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd')) as documentText,
        t.costCenter,
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

        $content = "Controlling Area\t";
        $content .= "Document Date(YYYYMMDD)\t";
        $content .= "Posting Date(YYYYMMDD)\t";
        $content .= "Document Text\t";
        $content .= "Cost Center\t";
        $content .= "SKF\t";
        $content .= "Quantity\t";
        $content .= "Text\n";
        // $content .= "\n";
        foreach ($data as $row) {
            $content .= $row->controllingArea . "\t";
            $content .= $row->documentDate . "\t";
            $content .= $row->posingDate . "\t";
            $content .= $row->documentText . "\t";
            $content .= $row->costCenter . "\t";
            $content .= $row->skf . "\t";
            $content .= $row->quantity . "\t";
            $content .= $row->text . "\n";
            // $content .= "\n";
        }
        $fileName = 'ActualHr CO' . date('dmY') . '.txt';
        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        ];

        return response()->make($content, 200, $headers);
    }
}
