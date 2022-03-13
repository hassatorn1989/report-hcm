<?php

namespace App\Http\Controllers\payslipsystem;

use App\Http\Controllers\Controller;
use App\Models\view_Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class auth_controller extends Controller
{
    public function index()
    {
        return view('payslipsystem.signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'emp_code' => 'required',
            'birth_date' => 'required',
        ]);
        $q =  view_Employee::whereRaw("empCode = {$request->emp_code} AND FORMAT(birthDate, 'ddMMyyyy') = {$request->birth_date}")->first();
        if (!empty($q)) {
            Auth::guard('payslip')->loginUsingId($q->empCode);
            return redirect()->route('payslip.dashboard.index');
            exit();
        }
        return redirect('/payslip')->with(['msg' => __('login.msg_err')]);
    }

    public function check_emp(Request $request)
    {
        $q = view_Employee::selectRaw("count(empCode) as empCode")->where('empCode', $request->emp_code_print)->first();
        echo ($q->empCode > 0) ? 'true' : 'false';
    }

    public function logout()
    {
        Auth::guard('payslip')->logout();
        return redirect()->route('payslip.auth.index');
    }
}
