<?php

namespace App\Http\Controllers;

use App\Models\tbm_MapAccount;
use App\Models\tbm_OrgUnit;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Excel;

class jv_mapaccount_controller extends Controller
{
    public function import()
    {
        $orgcop = tbm_OrgUnit::selectRaw("DISTINCT(orgCopCode) as orgCopCode")->get();
        $orgdiv = tbm_OrgUnit::selectRaw("DISTINCT(orgDivCode) as orgDivCode, orgUnitNameEN")->get();
        $orgdep = tbm_OrgUnit::selectRaw("DISTINCT(orgDepCode) as orgDepCode, orgUnitNameEN")->get();
        return view('jv_mapaccount_import', compact('orgdiv', 'orgdep', 'orgcop'));
    }

    public function lists(Request $request)
    {

        $q = tbm_MapAccount::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                // $q->whereRaw("orgJobCode = 'AG1'");
                if ($request->filter_orgDivCode != '') {
                    $q->where('orgDivCode',  $request->filter_orgDivCode);
                }
                if ($request->filter_orgDepCode != '') {
                    $q->where('orgDepCode',  $request->filter_orgDepCode);
                }
                if ($request->filter_orgJobCode != '') {
                    $q->where('orgJobCode',  $request->filter_orgJobCode);
                }
                if ($request->filter_costCenter !='') {
                    $q->where('costCenter',  $request->filter_costCenter);
                }
                if ($request->filter_accountCode !='') {
                    $q->where('accountCode',  $request->filter_accountCode);
                }
            })
            ->addColumn('action', function ($q) {
                $action = '<button class="btn btn-outline-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-default"onclick="edit_data(\'' . $q->orgCopCode . '\', \'' . $q->orgDivCode . '\', \'' . $q->orgDepCode . '\', \'' . $q->orgJobCode . '\', \'' . $q->orgLineCode . '\', \'' . $q->accountType . '\', \'' . $q->accountCode . '\')"> <i class="fas fa-edit"></i> ' . __('msg.btn_edit') . '</button> ';
                $action .= '<button class="btn btn-outline-danger btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-default-detail" onclick="destroy(\'' . $q->orgCopCode . '\', \'' . $q->orgDivCode . '\', \'' . $q->orgDepCode . '\', \'' . $q->orgJobCode . '\', \'' . $q->orgLineCode . '\', \'' . $q->accountType . '\', \'' . $q->accountCode . '\')"> <i class="fas fa-trash-alt"></i> ' . __('msg.btn_del') . '</button> ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'orgCopCode' => 'required',
            'orgDivCode' => 'required',
            'orgDepCode' => 'required',
            'orgJobCode' => 'required',
            // 'orgLineCode' => 'required',
            // 'accountType' => 'required',
            'accountTypeName' => 'required',
            // 'company' => 'required',
            'costCenter' => 'required',
            'accountCode' => 'required',
            // 'JDEcostCenter' => 'required',
            // 'JDEaccountCode' => 'required',
            'ioNumber' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $q = new tbm_MapAccount();
            $q->orgCopCode = '1';
            $q->orgDivCode = $request->orgDivCode;
            $q->orgDepCode = $request->orgDepCode;
            $q->orgJobCode = $request->orgJobCode;
            $q->orgLineCode = '';
            $q->accountType = ($request->accountTypeName == 'Regular') ? 'R' : 'O';
            $q->accountTypeName = $request->accountTypeName;
            $q->company = '1800';
            $q->costCenter = $request->costCenter;
            $q->accountCode = $request->accountCode;
            $q->JDEcostCenter = $request->costCenter;
            $q->JDEaccountCode = $request->accountCode;
            $q->ioNumber = $request->ioNumber;
            $q->save();
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request)
    {
        // $this->validate($request, [
        //     'orgCopCode' => 'required',
        //     'orgDivCode' => 'required',
        //     'orgDepCode' => 'required',
        //     'orgJobCode' => 'required',
        //     'orgLineCode' => 'required',
        //     'accountType' => 'required',
        //     'accountCode' => 'required',
        // ]);
        $q = tbm_MapAccount::where('orgCopCode', $request->orgCopCode)
            ->where('orgDivCode', $request->orgDivCode)
            ->where('orgDepCode', $request->orgDepCode)
            ->where('orgJobCode', !is_null($request->orgJobCode) ? $request->orgJobCode : '')
            ->where('orgLineCode', !is_null($request->orgLineCode) ? $request->orgLineCode : '')
            ->where('accountType', $request->accountType)
            ->where('accountCode', $request->accountCode)
            ->first();
        return response()->json($q);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            // 'orgCopCode' => 'required',
            'orgDivCode' => 'required',
            'orgDepCode' => 'required',
            'orgJobCode' => 'required',
            // 'orgLineCode' => 'required',
            // 'accountType' => 'required',
            'accountTypeName' => 'required',
            // 'company' => 'required',
            'costCenter' => 'required',
            'accountCode' => 'required',
            // 'JDEcostCenter' => 'required',
            // 'JDEaccountCode' => 'required',
            'ioNumber' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $q = new tbm_MapAccount();
            // $q->orgCopCode = $request->orgCopCode;
            $q->orgDivCode = $request->orgDivCode;
            $q->orgDepCode = $request->orgDepCode;
            $q->orgJobCode = $request->orgJobCode;
            // $q->orgLineCode = $request->orgLineCode;
            $q->accountType = ($request->accountTypeName == 'Regular') ? 'R' : 'O';
            $q->accountTypeName = $request->accountTypeName;
            // $q->company = $request->company;
            $q->costCenter = $request->costCenter;
            $q->accountCode = $request->accountCode;
            $q->JDEcostCenter = $request->costCenter;
            $q->JDEaccountCode = $request->accountCode;
            $q->ioNumber = $request->ioNumber;
            $q->save();
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request)
    {
        // $this->validate($request, [
        //     'id' => 'required'
        // ]);
        DB::beginTransaction();
        try {
            tbm_MapAccount::where('orgCopCode', $request->orgCopCode)
                ->where('orgDivCode', $request->orgDivCode)
                ->where('orgDepCode', $request->orgDepCode)
                ->where('orgJobCode', $request->orgJobCode)
                ->where('orgLineCode', $request->orgLineCode)
                ->where('accountType', $request->accountType)
                ->where('accountCode', $request->accountCode)
                ->delete();
            Session::flash('status_destroy', 'success');
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
