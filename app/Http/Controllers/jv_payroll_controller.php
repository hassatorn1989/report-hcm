<?php

namespace App\Http\Controllers;

use App\Imports\PayrollImport;
use App\Models\tbc_JV_Payroll_period;
use App\Models\tbm_PayPeriod;
use App\Models\tbt_JV_Payroll;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Excel;
use Illuminate\Support\Facades\Auth;

class jv_payroll_controller extends Controller
{
    public function import()
    {
        return view('jv_payroll_import');
    }

    public function store(Request $request)
    {
        Excel::import(new PayrollImport, $request->file('file_import'));
        tbt_JV_Payroll::where('docNumber', '!=', '')->delete();
        return redirect()->back()->with(['status' => true]);
    }

    public function lists(Request $request)
    {
        $q = tbt_JV_Payroll::whereRaw("accountCode NOT IN ('6004000000', '2025150010') ");
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("payrollDate between '{$datestart}' and '{$dateend}'");
                }
            })
            ->make();
    }

    public function payroll_period()
    {
        $year = tbm_PayPeriod::selectRaw("DISTINCT(year) as year")->orderBy('year', 'desc')->get();
        $period = tbm_PayPeriod::selectRaw("DISTINCT(period) as period")->orderBy('period', 'asc')->get();
        $round = tbm_PayPeriod::selectRaw("DISTINCT(round) as round")->orderBy('round', 'asc')->get();
        return view('jv_payroll_period', compact('year', 'period', 'round'));
    }

    public function payroll_period_store(Request $request)
    {
        $period = tbm_PayPeriod::where('year', $request->year)
            ->where('period', $request->period)
            ->where('round', $request->round)
            ->first();

        DB::beginTransaction();
        try {
            $sql = "
            INSERT INTO tbc_JV_Payroll_period (
                orgCopCode,
                orgDivCode,
                orgDepCode,
                payrollDate,
                costCenter,
                accountCode,
                amtWage,
                amtHour,
                ioNumber,
                jvReferance,
                docNumber,
                createBy
            )
                SELECT
                    j.orgCopCode,
                    j.orgDivCode,
                    j.orgDepCode,
                    j.payrollDate,
                    j.costCenter,
                    j.accountCode,
                    SUM ( j.amtWage ) AS amtWage,
                    SUM ( j.amtHour ) AS amtHour,
                    '' AS ioNumber,
                    j.jvReferance,
                    j.docNumber,
                    '" . Auth::user()->idx . "'as createBy
                FROM
                    dbo.tbt_JV_Payroll AS j
                    WHERE j.payrollDate BETWEEN '{$period->periodStart}' AND '{$period->periodEnd}' AND j.accountCode NOT IN ('6004000000', '2025150010')
                GROUP BY
                    j.orgCopCode,
                    j.orgDivCode,
                    j.orgDepCode,
                    j.payrollDate,
                    j.orgCopCode,
                    j.costCenter,
                    j.accountCode,
                    j.docNumber,
                    j.jvReferance
                    UNION ALL
                    SELECT
                    j.orgCopCode,
                    j.orgDivCode,
                    j.orgDepCode,
                    p.periodEnd as payrollDate,
                    ISNULL(t.costCenter, '') as costCenter,
                    ISNULL(t.accountCode, '') as accountCode,
                    Sum(j.leaveAmount) AS amtWage,
                    Sum(j.leaveHour) AS amtHour,
                    ISNULL(t.ioNumber, '') as ioNumber,
                    j.accountType as jvReferance,
                    '' as docNumber,
                    '" . Auth::user()->idx . "'as createBy
                    FROM
                    dbo.tbt_EmpLeave AS j
                    LEFT JOIN (SELECT DISTINCT
                    a.orgCopCode,
                    a.orgDivCode,
                    a.orgDepCode,
                    a.accountType,
                    a.costCenter,
                    a.accountCode,
                    a.ioNumber
                    FROM
                    dbo.tbm_MapAccount as a
                    ) AS t ON t.orgCopCode= j.orgCopCode AND t.orgDivCode= j.orgDivCode AND t.orgDepCode= j.orgDepCode AND t.accountType= j.accountType
                    INNER JOIN dbo.tbm_PayPeriod AS p ON j.[year] = p.[year] AND j.period = p.period AND j.round = p.round
                    WHERE
                    j.[year] = '{$request->year}' AND
                    j.period = '{$request->period}' AND
                    j.round = '{$request->round}'
                    GROUP BY
                    j.orgCopCode,
                    j.orgDivCode,
                    j.orgDepCode,
                    p.periodEnd,
                    t.costCenter,
                    t.accountCode,
                    t.ioNumber,
                    j.accountType";
            DB::statement($sql);
            DB::commit();
            return redirect()->back()->with(['status' => true]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function payroll_period_check(Request $request)
    {
        $period = tbm_PayPeriod::where('year', $request->year)
            ->where('period', $request->period)
            ->where('round', $request->round)
            ->first();
        echo$q = tbc_JV_Payroll_period::selectRaw("count(idx) as idx")->whereRaw("payrollDate BETWEEN '{$period->periodStart}' AND '{$period->periodEnd}'")->first();
        // echo ($q->idx > 0) ? '' : 'true';
    }

    public function payroll_period_lists(Request $request)
    {
        $q = tbc_JV_Payroll_period::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("payrollDate between '{$datestart}' and '{$dateend}'");
                }
            })
            ->make();
    }
}
