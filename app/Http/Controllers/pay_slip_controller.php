<?php

namespace App\Http\Controllers;

use App\Imports\PaySlipImport;
use App\Models\tbt_Payslip;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use DataTables;

class pay_slip_controller extends Controller
{
    public function index(Request $request)
    {
        return view('pay_slip');
    }

    public function store(Request $request)
    {
        Excel::import(new PaySlipImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => true]);
    }

    public function lists(Request $request)
    {
        $q = tbt_Payslip::query();
        return DataTables::eloquent($q)
            // ->filter(function ($q) use ($request) {
            //     if ($request->has('filter_full_name')) {
            //         $q->where('full_name', 'like', "%{$request->filter_full_name}%");
            //     }
            // })
            ->make();
    }

}
