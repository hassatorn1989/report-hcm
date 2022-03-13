<?php

namespace App\Imports;

use App\Models\tbm_MapAccount;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class MapAccountSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {



        return new tbm_MapAccount([
            'orgCopCode' => $row['jco'],
            'orgDivCode' => str_pad(substr($row['jref2'], 0, 3), 3, "0", STR_PAD_LEFT),
            'orgDepCode' => substr($row['jref2'], 3, 2),
            'costCenter' => $row['jcntr'],
            'accountCode' => $row['jacct'],
            'payrollDate' => date('Y-m-d', strtotime($row['jtdte'])),
            'docNumber' => $row['jref1'],
            // 'amtEmp' => $row['jtdte'],
            // 'amtWage' => $row['JAMT'],
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
        return ['orgCopCode', 'orgDivCode', 'orgDepCode', 'payrollDate'];
    }
}
