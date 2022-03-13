<?php

namespace App\Http\Controllers;

use App\Imports\TruckerPeriodImport;
use App\Models\tbm_PayPeriod;
use App\Models\tbt_TruckerPay_period;
use Illuminate\Http\Request;
use Excel;
use DataTables;
use Illuminate\Support\Facades\Auth;

class trucker_period_controller extends Controller
{
    public function index()
    {
        $year = tbm_PayPeriod::selectRaw("DISTINCT(year) as year")->orderBy('year', 'desc')->get();
        $period = tbm_PayPeriod::selectRaw("DISTINCT(period) as period")->orderBy('period', 'asc')->get();
        $round = tbm_PayPeriod::selectRaw("DISTINCT(round) as round")->orderBy('round', 'asc')->get();
        return view('trucker_period', compact('year', 'period', 'round'));
    }

    public function lists(Request $request)
    {
        $q = tbt_TruckerPay_period::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
            if ($request->filter_year != '' || $request->filter_period != '' || $request->filter_round != '') {
                $period = tbm_PayPeriod::where('year', $request->filter_year)
                    ->where('period', $request->filter_period)
                    ->where('round', $request->filter_round)
                    ->first();

                if (!is_null($period)) {
                    $datestart = $period->periodStart;
                    $dateend = $period->periodEnd;
                    $q->whereRaw("drivingStart >= '{$datestart}' AND drivingEnd <= '{$dateend}'");
                }else {
                    $q->whereRaw("drivingStart >= '' AND drivingEnd <= ''");
                }
            }
            })
            ->make();
    }

    public function store(Request $request)
    {
        Excel::import(new TruckerPeriodImport, $request->file('file_import'));
        return redirect()->back()->with(['status' => true]);
    }
}
