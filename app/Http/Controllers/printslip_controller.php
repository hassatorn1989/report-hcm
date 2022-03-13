<?php

namespace App\Http\Controllers;

use App\Models\tbt_Payslip;
use App\Models\view_Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class printslip_controller extends Controller
{
    public function index()
    {
        return view('printslip');
    }

    public function check_emp(Request $request)
    {
        $q = view_Employee::selectRaw("count(empCode) as empCode")->where('empCode', $request->emp_code)->first();
        echo ($q->empCode > 0) ? 'true' : 'false';
    }

    public function get_date(Request $request)
    {
        $payslip = tbt_Payslip::selectRaw("FORMAT (PayDate, 'yyyy-MM-dd') PayDateValue, FORMAT (PayDate, 'dd/MM/yyyy') PayDate")->whereRaw("EmpCode = '" . $request->emp_code . "' AND  PayDate >= DATEADD(m,-6,DATEDIFF(d,0,(SELECT TOP 1 PayDate FROM [dbo].[tbt_Payslip] WHERE EmpCode = '" . $request->emp_code . "' ORDER BY PayDate DESC)))")->get();
        return response()->json($payslip);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'emp_code' => 'required',
            'pay_date' => 'required',
        ]);
        $rows = tbt_Payslip::whereRaw("EmpCode = '$request->emp_code' AND PayDate = '{$request->pay_date}'")->first();
        return view('payslipsystem.pdf.print_slilp1', compact('rows'));
    }
}
