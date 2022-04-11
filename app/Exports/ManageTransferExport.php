<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ManageTransferExport implements FromView
{
    // protected $period;
    // protected $date_post;

    function __construct()
    {

    }
    public function view(): View
    {
        return view('exports.manage_transfer_export');
    }

}
