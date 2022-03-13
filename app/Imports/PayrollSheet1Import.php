<?php

namespace App\Imports;

use App\Models\tbt_JV_Payroll;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PayrollSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tbt_JV_Payroll([
            'orgCopCode' => $row['jco'],
            'orgDivCode' => str_pad(substr($row['jref2'], 0, 3), 3, "0", STR_PAD_LEFT),
            'orgDepCode' => substr($row['jref2'], 3, 2),
            'costCenter' => $row['jcntr'],
            'accountCode' => $row['jacct'],
            'payrollDate' => date('Y-m-d', strtotime($row['jtdte'])),
            'docNumber' => $row['jref1'],
            // 'amtEmp' => $row['jtdte'],
             'amtWage' => floatval($row['jamt']),
            'amtHour' => floatval($row['jhr']),
            'jvReferance' => $row['jdes'],
            'createBy' => Auth::user()->idx,
        ]);
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy()
    {
        return [];
    }
}
