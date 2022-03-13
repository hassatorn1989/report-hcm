<?php

namespace App\Imports;

use App\Models\tbm_OrgUnit;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class OrgUnitSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tbm_OrgUnit([
            'orgCopCode' => $row['emco'],
            'orgDivCode' => str_pad($row['dddiv'], 3, "0", STR_PAD_LEFT),
            'orgDepCode' => $row['dddept'],
            'orgUnitNameEN' => $row['ddname'],
            'orgUnitNameTH' => $row['ddthai'],
            'orgTypeCode' => ($row['dddept'] == '00') ? '2' : '3',
            'OrgTypeName' => ($row['dddept'] == '00') ? 'Division' : 'Department',
            'createBy' => Auth::user()->idx,
        ]);
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy()
    {
        return ['OrgCopCode', 'OrgDivCode', 'OrgDepCode'];
    }
}
