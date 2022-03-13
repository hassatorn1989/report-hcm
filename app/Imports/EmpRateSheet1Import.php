<?php

namespace App\Imports;

use App\Models\tbm_EmpRate;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;


class EmpRateSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        return new tbm_EmpRate([
            'orgCopCode' => $row['emco'],
            'empCode' => $row['emid'],
            'empRate' => floatval($row['empar']),
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
