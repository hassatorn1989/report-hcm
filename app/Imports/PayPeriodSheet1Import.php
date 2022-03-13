<?php

namespace App\Imports;

use App\Models\tbm_PayPeriod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
// WithBatchInserts, WithUpserts
class PayPeriodSheet1Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tbm_PayPeriod([
            'year' => $row['pyr'],
            'period' => $row['ppd'],
            'round' => $row['pno'],
            'periodStart' => date('Y-m-d', strtotime($row['psdte'])),
            'periodEnd' => date('Y-m-d', strtotime($row['pedte'])),
            // 'periodPay' => ($row['dddept'] == '00') ? '2' : '3',
            'periodFlag' => $row['pflag'],
            'createBy' => Auth::user()->idx,
        ]);
    }

    // public function batchSize(): int
    // {
    //     return 20;
    // }

    // public function uniqueBy()
    // {
    //     // return ['OrgCopCode', 'OrgDivCode', 'OrgDepCode'];
    // }
}
