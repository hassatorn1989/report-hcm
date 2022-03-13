<?php

namespace App\Http\Controllers\payslipsystem;

use App\Http\Controllers\Controller;
use App\Models\tbt_Payslip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class print_controller extends Controller
{
    public function slip1(Request $request)
    {
        $this->validate($request, [
            'emp_code_print' => 'required',
        ]);
        $rows = tbt_Payslip::where('EmpCode', $request->emp_code_print)->orderby('PayDate', 'DESC')->take(1)->first();
        return view('payslipsystem.pdf.print_slilp1', compact('rows'));
    }

    public function slip2(Request $request)
    {
        $this->validate($request, [
            'pay_date' => 'required',
        ]);
        $rows = tbt_Payslip::whereRaw("EmpCode = '". Auth::guard('payslip')->user()->empCode."' AND PayDate = '{$request->pay_date}'")->first();
        return view('payslipsystem.pdf.print_slilp1', compact('rows'));
    }
}
