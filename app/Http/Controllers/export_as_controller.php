<?php

namespace App\Http\Controllers;

use App\Exports\ManageTransferExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class export_as_controller extends Controller
{
    public function manage_transfer ()
    {
        return view('export_manage_transfer');
    }

    public function manage_transfer_lists()
    {
        // return view('export_manage_transfer');
    }
    public function export_manage_transfer()
    {
        return Excel::download(new ManageTransferExport(), 'ManageTransfer-' . date('YmdHis') . '.xls', \Maatwebsite\Excel\Excel::XLS);
    }


}
