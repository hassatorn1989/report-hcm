<?php

namespace App\Http\Controllers;

use App\Models\view_log;
use Illuminate\Http\Request;
use DataTables;
class log_controller extends Controller
{
    public function index()
    {
        return view('report_log');
    }

    public function lists(Request $request)
    {
        $q = view_log::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->addColumn('log_datetime', function ($q) {
                return date('Y-m-d H:i:s', strtotime($q->log_datetime));
            })
            ->rawColumns(['log_datetime'])
            ->make();
    }
}
