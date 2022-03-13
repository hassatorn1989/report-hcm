<?php

namespace App\Http\Controllers\payslipsystem;

use App\Http\Controllers\Controller;
use App\Models\tbt_Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboard_controller extends Controller
{
    public function index()
    {
        $payslip = tbt_Payslip::selectRaw("FORMAT (PayDate, 'yyyy-MM-dd') PayDate")->whereRaw("EmpCode = '" . Auth::guard('payslip')->user()->empCode . "' AND  PayDate >= DATEADD(m,-6,DATEDIFF(d,0,(SELECT TOP 1 PayDate FROM [dbo].[tbt_Payslip] WHERE EmpCode = '" . Auth::guard('payslip')->user()->empCode . "' ORDER BY PayDate DESC)))")->get();
        // dd($payslip);
        return view('payslipsystem.dashboard', compact('payslip'));
    }
}
