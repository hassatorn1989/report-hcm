<?php

namespace App\Http\Controllers;

use App\Models\tb_menu;
use App\Models\tb_user;
use App\Models\tb_user_role;
use App\Models\view_user;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class user_controller extends Controller
{
    public function index()
    {
        $menu =
            tb_menu::whereRaw("parent_id is null")->orderBy('menu_priority', 'asc')->get();
        return view('user', compact('menu'));
    }

    public function lists(Request $request)
    {
        $q = view_user::query();
        return DataTables::eloquent($q)
            ->filter(function ($q) use ($request) {
                if ($request->has('filter_full_name')) {
                    $q->where('full_name', 'like', "%{$request->filter_full_name}%");
                }
            })
            ->addColumn('user_role', function ($q) {
                return ($q->user_role == 'admin') ? '<span class="badge badge-success">Admin</span>' : '<span class="badge badge-danger">User</span>';
            })
            ->addColumn('hr_role', function ($q) {
                return ($q->hr_role == 'yes') ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('action', function ($q) {
                $action = '';
                if ($q->user_role != 'admin') {
                $action .= '<button class="btn btn-outline-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-user-role"onclick="get_role(\'' . $q->idx . '\')"> <i class="fas fa-edit"></i> ' . __('msg.btn_manage_role') . '</button> ';
                }

                $action .= '<button class="btn btn-outline-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-default"onclick="edit_data(\'' . $q->idx . '\')"> <i class="fas fa-edit"></i> ' . __('msg.btn_edit') . '</button> ';
                $action .= '<button class="btn btn-outline-danger btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modal-default-detail" onclick="destroy(\'' . $q->idx . '\')"> <i class="fas fa-trash-alt"></i> ' . __('msg.btn_del') . '</button> ';
                return $action;
            })
            ->rawColumns(['action', 'user_role', 'hr_role'])
            ->make();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'empCode' => 'required',
            'user_name' => 'required',
            'user_last' => 'required',
            'username' => 'required',
            'password' => 'required',
            // 'user_role' => 'required',
        ]);
        // dd($request);
        DB::beginTransaction();
        try {
            $q = new tb_user();
            $q->empCode = $request->empCode;
            $q->user_name = $request->user_name;
            $q->user_last = $request->user_last;
            $q->username = $request->username;
            $q->password = Hash::make($request->password);
            $q->user_role = (!empty($request->user_role)) ? 'admin' : 'user';
            $q->hr_role = (!empty($request->hr_role)) ? 'yes' : 'no';
            $q->save();
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $q = tb_user::find($request->id);
        return response()->json($q);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'empCode' => 'required',
            'user_name' => 'required',
            'user_last' => 'required',
            'username' => 'required',
            // 'user_role' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $q = tb_user::find($request->id);
            $q->empCode = $request->empCode;
            $q->user_name = $request->user_name;
            $q->user_last = $request->user_last;
            $q->username = $request->username;
            if (!is_null($request->password)) {
                $q->password = Hash::make($request->password);
            }
            $q->user_role = (!empty($request->user_role)) ? 'admin' : 'user';
            $q->hr_role = (!empty($request->hr_role)) ? 'yes' : 'no';
            $q->save();
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $q = tb_user::destroy($request->id);
            Session::flash('status_destroy', 'success');
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function get_role(Request $request)
    {
        $q = tb_menu::whereRaw("parent_id is null")->with([
            'get_sub_menu' => function ($q) use ($request) {
                $q->selectRaw("*,
                (select count(tb_user_role.id) from tb_user_role where tb_user_role.menu_id = tb_menu.id and user_id = '{$request->id}') as user_role
                ");
            }
        ])->get();
        return response()->json($q);
    }

    public function store_role(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'menu' => 'required'
        ]);
        DB::beginTransaction();
        try {
            tb_user_role::where('user_id', $request->user_id)->delete();
            if (count($request->menu) > 0) {
                foreach ($request->menu as $key => $value) {
                    $q = new tb_user_role();
                    $q->user_id = $request->user_id;
                    $q->menu_id = $value;
                    $q->save();
                }
            }
            DB::commit();
            return redirect()->back()->with(['status' => 'success']);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
