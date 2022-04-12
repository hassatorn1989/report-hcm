<?php

namespace App\Http\Controllers;

use App\Imports\EmpLeaveImport;
use App\Imports\EmpoyeeImport;
use App\Imports\EmpRateImport;
use App\Imports\OrgUnitImport;
use App\Imports\PayPeriodImport;
use App\Imports\TimeWorkingCheck;
use App\Imports\TranferImport;
use App\Imports\TimeWorkingImport;
use App\Imports\TimeWorkingOvertimeImport;
use App\Models\tbc_DepRate_daily;
use App\Models\tbc_JV_Accrue_daily;
use App\Models\tbc_JV_Transfer_daily;
use App\Models\tbm_Employee;
use App\Models\tbm_EmpRate;
use App\Models\tbm_OrgUnit;
use App\Models\tbm_PayPeriod;
use App\Models\tbt_EmpLeave;
use App\Models\tbt_TimeWorking_hour;
use App\Models\tbt_JV_Transfer;
use Illuminate\Http\Request;
use Excel;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class jv_tranfer_controller extends Controller
{

    public function import_file1()
    {
        return view('jv_tranfer_import_file1');
    }

    public function import_file1_store(Request $request)
    {
        tbm_Employee::truncate();
        tbm_EmpRate::truncate();
        Excel::import(new EmpoyeeImport, $request->file('file_import'));
        Excel::import(new EmpRateImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file1_lists1(Request $request)
    {
        $q = tbm_Employee::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->make();
    }

    public function import_file1_lists2(Request $request)
    {
        $q = tbm_EmpRate::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function import_file2()
    {
        return view('jv_tranfer_import_file2');
    }

    public function import_file2_store(Request $request)
    {
        Excel::import(new OrgUnitImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file2_lists(Request $request)
    {
        $q = tbm_OrgUnit::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->make();
    }

    public function import_file3()
    {
        return view('jv_tranfer_import_file3');
    }

    public function import_file3_store(Request $request)
    {
        ini_set('memory_limit', '-1');
        // dd($request->file('file_import'));
        // Excel::raw($request->file('file_import'));
        // Excel::import(new TimeWorkingImport, $request->file('file_import'));
        Excel::import(new TimeWorkingImport, $request->file('file_import'));
        Excel::import(new TimeWorkingOvertimeImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file3_lists(Request $request)
    {
        $q = tbt_TimeWorking_hour::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("dateIn between '{$datestart}' and '{$dateend}'");
                }
            })
            ->addColumn('timeIn', function ($q) {
                return date('H:i:s', strtotime($q->timeIn));
            })
            ->addColumn('timeOut', function ($q) {
                return date('H:i:s', strtotime($q->timeIn));
            })
            ->make();
    }



    public function import_file4()
    {
        return view('jv_tranfer_import_file4');

    }

    public function import_file4_store(Request $request)
    {

        Excel::import(new TranferImport, $request->file('file_import'));
        tbt_JV_Transfer::whereRaw("(docNumber is null or docNumber = '' ) OR amtHour = '0'")->delete();
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file4_lists(Request $request)
    {
        $q = tbt_JV_Transfer::whereRaw("(docNumber is NOT null AND docNumber <> '' ) OR amtHour = '0'");
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

    public function import_file5()
    {
        return view('jv_tranfer_import_file5');
    }

    public function import_file5_store(Request $request)
    {
        ini_set('memory_limit', '-1');
        tbm_PayPeriod::truncate();
        Excel::import(new PayPeriodImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file5_lists(Request $request)
    {
        $q = tbm_PayPeriod::query();
        return DataTables::eloquent($q)
            ->make();
    }

    public function import_file6()
    {
        $year = tbm_PayPeriod::selectRaw("DISTINCT(year) as year")->orderBy('year', 'desc')->get();
        $period = tbm_PayPeriod::selectRaw("DISTINCT(period) as period")->orderBy('period', 'asc')->get();
        $round = tbm_PayPeriod::selectRaw("DISTINCT(round) as round")->orderBy('round', 'asc')->get();
        return view('jv_tranfer_import_file6', compact('year', 'period', 'round'));
    }

    public function import_file6_store(Request $request)
    {
        Excel::import(new EmpLeaveImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => 'success']);
    }

    public function import_file6_lists(Request $request)
    {
        $q = tbt_EmpLeave::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->filter_year != '') {
                    $q->where('year', $request->filter_year);
                }
                if ($request->filter_period != '') {
                    $q->where('period', $request->filter_period);
                }
                if ($request->filter_round != '') {
                    $q->where('round', $request->filter_round);
                }
            })
            ->make();
    }

    public function report()
    {
        return view('jv_tranfer_report');
    }

    public function report_lists(Request $request)
    {
        $q = tbc_DepRate_daily::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("DateRate between '{$datestart}' and '{$dateend}'");
                }
            })
            ->make();
    }

    public function report_check(Request $request)
    {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
        $count = tbc_DepRate_daily::where('DateRate', $date)->where('isActive', 'Y')->count();
        echo ($count > 0) ? 'false' : 'true';
    }

    public function report_process(Request $request)
    {
        DB::beginTransaction();
        try {
            $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
            $sql = "
            INSERT INTO tbc_DepRate_daily (
                DateRate,
                orgCopCode,
                orgDivCode,
                orgDepCode,
                amtEmp,
                amtWage,
                avgRateHour
            )
                SELECT
                t.dateIn,
                e.orgCopCode,
                e.orgDivCode,
                e.orgDepCode,
                Count(e.empCode) AS amtEmp,
                Sum(er.empRate) AS amtWage,
                (Sum(er.empRate)/Count(e.empCode)) as avgRate
                FROM
                dbo.tbm_Employee AS e
                INNER JOIN dbo.tbm_EmpRate AS er ON e.orgCopCode = er.orgCopCode AND e.empCode = er.empCode
                INNER JOIN dbo.tbt_TimeWorking_hour AS t ON e.orgCopCode = t.orgCopCode AND e.empCode = t.empCode
                WHERE t.shiftType='Normal Shift' and ( t.dateIn =  '" . $date . "')
                GROUP BY
                e.orgCopCode,
                e.orgDivCode,
                e.orgDepCode,
                t.dateIn";
            DB::statement($sql);
            DB::commit();
            return redirect()->back()->with(['status' => true]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function report_tranfer_daily()
    {
        $tranfer_daily = tbc_JV_Transfer_daily::paginate(20);
        return view('jv_tranfer_daily_report', compact('tranfer_daily'));
    }

    public function report_tranfer_daily_lists(Request $request)
    {
        $q = tbc_JV_Transfer_daily::selectRaw("
        idx,
	transferDate,
	orgCopCode,
	orgDivCode,
	orgDepCode,
	amtHour,
CASE
	WHEN accountCode <> '6000000010' THEN
	amtWage ELSE ( amtWage * 1.5 )
	END AS amtWage,
	costCenter,
	ioNumber,
	accountCode,
	jvReferance,
	isActive,
	isCalculate,
	createBy,
	created_at,
	updated_at,
	docNumber,
	avgRateHour
        ");
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("transferDate between '{$datestart}' and '{$dateend}'");
                }
            })
            ->make();
    }

    public function report_tranfer_daily_check(Request $request)
    {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
        $count = tbc_JV_Transfer_daily::where('transferDate', $date)->where('isActive', 'Y')->count();
        echo ($count > 0) ? 'false' : 'true';
    }

    public function report_tranfer_daily_process(Request $request)
    {
        DB::beginTransaction();
        try {
            $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
             $sql = "
            INSERT INTO tbc_JV_Transfer_daily (
            transferDate,
            orgCopCode,
            orgDivCode,
            orgDepCode,
            amtHour,
            amtWage,
            costCenter,
            ioNumber,
            accountCode,
            jvReferance,
            isActive,
            isCalculate,
            docNumber,
            avgRateHour
        ) SELECT
        t.payrollDate,
        t.orgCopCode,
        t.orgDivCode,
        t.orgDepCode,
        t.amtHour,
        (
	    CASE
			WHEN LEFT ( t.accountCode, 3 ) = '542'
		THEN
				t.amtHour* 1.5 * tmp.rate ELSE t.amtHour* tmp.rate
			END
			) AS amtWage,
			t.costCenter,
			'' AS ioNumber,
			t.accountCode,
			t.jvReferance,
			'Y' AS isActive,
			'N' AS isCalculate,
            t.docNumber,
            tmp.avgRateHour
		FROM
			dbo.tbt_JV_Transfer AS t
			INNER JOIN (
			SELECT
				t.payrollDate,
				t.docNumber,
				MAX ( dr.avgRateHour ) AS rate,
				t.jvReferance,
                avg(dr.avgRateHour) as avgRateHour
			FROM
				dbo.tbt_JV_Transfer AS t
				INNER JOIN dbo.tbc_DepRate_daily AS dr ON t.orgDivCode = dr.orgDivCode
				AND t.orgDepCode = dr.orgDepCode
				AND t.payrollDate = dr.DateRate
			WHERE
				t.amtHour < 0
			GROUP BY
				t.payrollDate,
				t.docNumber,
				t.jvReferance
			) AS tmp ON t.payrollDate= tmp.payrollDate
	        AND t.docNumber= tmp.docNumber where (tmp.payrollDate = '" . $date . "')";
            // dd($sql);
            DB::statement($sql);
            DB::commit();
            return redirect()->back()->with(['status' => true]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public function report_accrue_daily()
    {
        return view('jv_accrue_daily_report');
    }

    public function report_accrue_daily_lists(Request $request)
    {
        $q = tbc_JV_Accrue_daily::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->date_filter != '') {
                    $datecut = explode(" - ", $request->date_filter);
                    $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
                    $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
                    $q->whereRaw("accrueDate between '{$datestart}' and '{$dateend}'");
                }
            })
            ->make();
    }

    public function report_accrue_daily_check(Request $request)
    {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
        $count = tbc_JV_Accrue_daily::where('accrueDate', $date)->where('isActive', 'Y')->count();
        echo ($count > 0) ? 'false' : 'true';
    }

    public function report_accrue_daily_process(Request $request)
    {
        DB::beginTransaction();
        try {
            $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
            $sql = "
            INSERT INTO tbc_JV_Accrue_daily ( accrueDate, companyCode, costCenter, accountCode, ioNumber, amtWage, amtHour, isActive, createBy, created_at, updated_at, EmpRate )
SELECT
t.dateIn,
t.company,
t.costCenter,
t.accountCode,
t.ioNumber,
SUM ( t.amtWage ) AS amtWage,
SUM ( t.workHour ) AS amtHour,
'Y' AS isActive,
'' AS createBy,
'' AS create_at,
'' AS update_at,
 avg(t.empRate ) as empRate
FROM
	(
SELECT
  er.empRate,
	t.dateIn,
	t2.company,
	t2.costCenter,
	t2.accountCode,
	t2.ioNumber,
	( CASE WHEN t.accountType = 'O' THEN t.workHour* 1.5 * er.empRate ELSE t.workHour* er.empRate END ) AS amtWage,
	t.workHour
FROM
	dbo.tbt_TimeWorking_hour AS t
	LEFT JOIN dbo.tbm_EmpRate AS er ON t.orgCopCode = er.orgCopCode
	AND t.empCode = er.empCode
	LEFT JOIN dbo.tbm_Employee AS e ON er.orgCopCode = e.orgCopCode
	AND er.empCode = e.empCode
	LEFT JOIN (
SELECT DISTINCT
	a.orgCopCode,
	a.company,
	a.orgDivCode,
	a.orgDepCode,
	a.accountType,
	a.costCenter,
	a.accountCode,
	a.ioNumber

FROM
	dbo.tbm_MapAccount AS a ) AS t2 ON t2.orgCopCode= e.orgCopCode
	AND t2.orgDivCode= e.orgDivCode
	AND t2.orgDepCode= e.orgDepCode
	AND t2.accountType= t.accountType
WHERE
	t.dateIn = '{$date}'
	) AS t
GROUP BY
	t.dateIn,
	t.company,
	t.costCenter,
	t.accountCode,
	t.ioNumber
ORDER BY
	t.dateIn,
	t.costCenter,
	t.accountCode";
            DB::statement($sql);
            DB::commit();
            return redirect()->back()->with(['status' => true]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function check_calculate(Request $request)
    {
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_calculate)));
        $sql = "SELECT
        t.docNumber,
        sum(t.amtHour) as amtHour
        FROM
        dbo.tbt_JV_Transfer AS t
        where (t.payrollDate = '{$date}')
        GROUP BY t.docNumber
        HAVING  sum(t.amtHour)<>0";
        $q = DB::select($sql);
        $data = [];
        if (count($q) > 0) {
            $data = [
                'status' => false,
                'data' => $q,
            ];
        }else {
            $data = [
                'status' => true
            ];
        }

        return response()->json($data);
    }
}
