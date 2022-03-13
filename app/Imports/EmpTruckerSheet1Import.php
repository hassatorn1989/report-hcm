<?php

namespace App\Imports;

use App\Models\tbm_EmpTrucker;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class EmpTruckerSheet1Import implements ToModel, WithHeadingRow,  WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        return new tbm_EmpTrucker([
            'empCode' => $row['emco'],
            'routeFee' => $row['emco'],
            'routing' => $row['emco'],
            'createBy' => Auth::user()->idx,
        ]);
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function uniqueBy()
    {
        return ['orgCopCode', 'empCode'];
    }
}
