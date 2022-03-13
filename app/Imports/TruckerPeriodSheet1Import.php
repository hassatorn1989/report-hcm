<?php

namespace App\Imports;

use App\Models\tbt_TruckerPay_period;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\WithUpserts;

class TruckerPeriodSheet1Import implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        $i = 1;
        foreach ($rows as $key=>$row) {
            if (floatval($row['bxbtot']) > 0) {
            tbt_TruckerPay_period::create([
                    'year' => $row['bxyr'],
                    'period' => $row['bxprd'],
                    'round' => $row['bxwk'],
                    'routing' => $row['bxbcde'],
                    'trucker' => $row['bxname'],
                    'drivingStart' => date('Y-m-d', strtotime($row['bxsdat'])),
                    'drivingEnd' => date('Y-m-d', strtotime($row['bxedat'])),
                    'drivingDay' => $row['bxseq'],
                    'truckerPayDate' => date('Y-m-d', strtotime($row['bxdate'])),
                    'truckerPayAmt' => $row['bxbtot'],
                    'truckerAccount' => str_replace('-', '', $row['bxbac']),
                    'vendorNo' => $row['vendorno'],
                    'invoiceNo' => $row['invoiceno'] . '.' . str_pad(($i++), 3, "0", STR_PAD_LEFT),
                    'createBy' => Auth::user()->idx,
                ]);
            }
        }
    }
}
