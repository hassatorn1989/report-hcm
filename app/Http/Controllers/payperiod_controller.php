<?php

namespace App\Http\Controllers;

use App\Imports\PayPeriodImport;
use App\Models\tbm_PayPeriod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Excel;

class payperiod_controller extends Controller
{
    public function import()
    {
        return view('jv_tranfer_import_file2');
    }

    public function store(Request $request)
    {
        tbm_PayPeriod::truncate();
        Excel::import(new PayPeriodImport, $request->file('file_import'));
    }

    public function lists(Request $request)
    {
        $q = tbm_PayPeriod::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->make();
    }
}
