<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class auth_controller extends Controller
{
    public function index()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with(['status' => 'success']);
        } else {
            return redirect()->back()->with(['msg' => __('msg.login_false')]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index');
    }
}
