<?php

namespace App\Http\Controllers;

use App\Models\tbm_MapAccount;
use App\Models\tbm_OrgUnit;
use App\Models\tbt_preparation;
use App\Models\view_TimeWorking_hour_preparation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class preparation_controller extends Controller
{
    public function index()
    {
        $OrgUnit = tbm_OrgUnit::where('orgTypeCode', '3')->get();
        return view('preparation', compact('OrgUnit'));
    }


    public function lists(Request $request)
    {
        $q = view_TimeWorking_hour_preparation::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->filter_dateCalculate != '') {
                    $filter_dateCalculate = date('Y-m-d', strtotime(str_replace('/', '-', $request->filter_dateCalculate)));
                    $q->where('dateIn',  $filter_dateCalculate);
                }
                if ($request->filter_OrgUnit != '') {
                    $OrgUnitArr = explode('-', $request->filter_OrgUnit);
                    $q->where('orgDivCode',  $OrgUnitArr[0]);
                    $q->where('orgDepCode',  $OrgUnitArr[1]);
                }
            })
            ->addColumn('dateIn', function ($q) {
                return date('d/m/Y', strtotime($q->dateIn));
            })
            ->addColumn('action', function ($q) {
                $action = '<button class="btn btn-outline-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-default" onclick="edit_data(\'' . $q->dateIn . '\', \'' . $q->orgDivCode . '\', \'' . $q->orgDepCode . '\',)"> <i class="fas fa-edit"></i> ' . __('msg.btn_edit') . '</button> ';
                $action .= '<button class="btn btn-outline-danger btn-sm waves-effect waves-light" onclick="destroy(\'' . $q->dateIn . '\', \'' . $q->orgDivCode . '\', \'' . $q->orgDepCode . '\')"> <i class="fas fa-trash-alt"></i> ' . __('msg.btn_del') . '</button> ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'dateCalculate' => 'required',
            'OrgUnit' => 'required',
            'costCenter' => 'required',
            'accountCode' => 'required',
            'hoursPrice' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $OrgUnitArr = explode('-', $request->OrgUnit);
            $dateCalculate = date('Y-m-d', strtotime(str_replace('/', '-', $request->dateCalculate)));
            if (count($request->costCenter) > 0) {
                for ($i = min(array_keys($request->costCenter)); $i <= max(array_keys($request->costCenter)); $i++) {
                    if (!empty($request->costCenter[$i])) {
                        $OrgUnit2Arr = explode('-', $request->OrgUnit_row[$i]);
                        $q1 = new tbt_preparation();
                        $q1->dateCalculate = $dateCalculate;
                        $q1->orgDivCode = $OrgUnitArr[0];
                        $q1->orgDepCode = $OrgUnitArr[1];
                        $q1->orgDivCode2 = $OrgUnit2Arr[0];
                        $q1->orgDepCode2 = $OrgUnit2Arr[1];
                        $q1->costCenter = $request->costCenter[$i];
                        $q1->accountCode = $request->accountCode[$i];
                        $q1->hoursPrice = $request->hoursPrice[$i];
                        $q1->accountType = ($request->accountCode[$i] == '6000000010') ? 'O' : 'R';
                        $q1->save();
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request)
    {
        $dateCalculate = date('d/m/Y', strtotime($request->dateCalculate));
        $OrgUnit = $request->orgDivCode . '-' . $request->orgDepCode;
        $preparation = tbt_preparation::where('dateCalculate', $request->dateCalculate)
            ->where('orgDivCode', $request->orgDivCode)
            ->where('orgDepCode', $request->orgDepCode)
            ->get();
        $OrgUnit_row = tbm_OrgUnit::where('orgTypeCode', '3')->get();
        $costCenter = tbm_MapAccount::selectRaw('DISTINCT(costCenter) as costCenter')->orderBy('costCenter', 'ASC')->get();
        $accountCode = tbm_MapAccount::selectRaw('DISTINCT(accountCode) as accountCode')->orderBy('accountCode', 'ASC')->get();
        return response()->json(compact('dateCalculate', 'OrgUnit', 'preparation', 'OrgUnit_row', 'costCenter', 'accountCode'));
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'dateCalculate' => 'required',
            'OrgUnit' => 'required',
            'costCenter' => 'required',
            'accountCode' => 'required',
            'hoursPrice' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $OrgUnitArr = explode('-', $request->OrgUnit);
            $dateCalculate = date('Y-m-d', strtotime(str_replace('/', '-', $request->dateCalculate)));
            if (count($request->costCenter) > 0) {
                tbt_preparation::where('dateCalculate', $dateCalculate)
                    ->where('orgDivCode', $OrgUnitArr[0])
                    ->where('orgDepCode', $OrgUnitArr[1])
                    ->delete();
                for ($i = min(array_keys($request->costCenter)); $i <= max(array_keys($request->costCenter)); $i++) {
                    if (!empty($request->costCenter[$i])) {
                        $OrgUnit2Arr = explode('-', $request->OrgUnit_row[$i]);
                        $q1 = new tbt_preparation();
                        $q1->dateCalculate = $dateCalculate;
                        $q1->orgDivCode = $OrgUnitArr[0];
                        $q1->orgDepCode = $OrgUnitArr[1];
                        $q1->orgDivCode2 = $OrgUnit2Arr[0];
                        $q1->orgDepCode2 = $OrgUnit2Arr[1];
                        $q1->costCenter = $request->costCenter[$i];
                        $q1->accountCode = $request->accountCode[$i];
                        $q1->hoursPrice = $request->hoursPrice[$i];
                        $q1->accountType = ($request->accountCode[$i] == '6000000010') ? 'O' : 'R';
                        $q1->save();
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'dateCalculate' => 'required',
            'orgDivCode' => 'required',
            'orgDepCode' => 'required',
        ]);
        tbt_preparation::where('dateCalculate', $request->dateCalculate)
            ->where('orgDivCode', $request->orgDivCode)
            ->where('orgDepCode', $request->orgDepCode)
            ->delete();
    }

    public function check_data(Request $request)
    {
        $OrgUnitArr = explode('-', $request->OrgUnit);
        $dateCalculate = date('Y-m-d', strtotime(str_replace('/', '-', $request->dateCalculate)));
        $q1 = DB::selectOne("SELECT
            ISNULL(COUNT(e.orgDivCode), 0) as counts
            FROM
            dbo.tbt_TimeWorking_hour AS t
            INNER JOIN dbo.tbm_Employee AS e ON t.orgCopCode = e.orgCopCode AND t.empCode = e.empCode
            WHERE
            t.dateIn = '{$dateCalculate}' AND
            e.orgDivCode = '{$OrgUnitArr[0]}' AND
            e.orgDepCode = '{$OrgUnitArr[1]}'");

        $q2 =  tbt_preparation::selectRaw("count(idx) as idx")->where('dateCalculate', $dateCalculate)
            ->where('orgDivCode', $OrgUnitArr[0])
            ->where('orgDepCode', $OrgUnitArr[1])
            ->first();
        return response()->json(['check_TimeWorking_hour' => $q1->counts, 'check_preparation' => $q2->idx]);
    }

    public function get_org()
    {
        $OrgUnit = tbm_OrgUnit::where('orgTypeCode', '3')->get();
        $costCenter = tbm_MapAccount::selectRaw('DISTINCT(costCenter) as costCenter')->orderBy('costCenter', 'ASC')->get();
        $accountCode = tbm_MapAccount::selectRaw('DISTINCT(accountCode) as accountCode')->orderBy('accountCode', 'ASC')->get();
        return response()->json(compact('OrgUnit', 'costCenter', 'accountCode'));
    }
}
