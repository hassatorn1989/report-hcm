<?php

namespace App\Http\Controllers;

use App\Imports\EmpTruckerImport;
use App\Models\tbm_EmpTrucker;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Excel;

class jv_emptrucker_controller extends Controller
{
    public function index()
    {
        return view('jv_emptrucker_import');
    }

    public function store(Request $request)
    {
        tbm_EmpTrucker::truncate();
        Excel::import(new EmpTruckerImport, $request->file('file_import'));
    }

    public function lists(Request $request)
    {
        $q = tbm_EmpTrucker::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->make();
    }
}
