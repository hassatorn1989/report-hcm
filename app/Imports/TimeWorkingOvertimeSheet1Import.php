<?php

namespace App\Imports;


use App\Models\tbt_TimeWorking_hour;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

// WithBatchInserts,WithChunkReading,
class TimeWorkingOvertimeSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        if (floatval($row['tohr']) > 0) {
            return new tbt_TimeWorking_hour([
                'orgCopCode' => $row['tcom'],
                'empCode' => $row['temid'],
                'dateIn' => date('Y-m-d', strtotime($row['tdtei'])),
                'timeIn' => date('H:i', strtotime($row['ttmei'])),
                'dateOut' => date('Y-m-d', strtotime($row['tdteo'])),
                'timeOut' => date('H:i', strtotime($row['ttmeo'])),
                'workHour' => floatval($row['tohr']),
                'accountType' => 'O',
                'shiftType' => 'After Work Time',
                'createBy' => Auth::user()->idx,
            ]);
        }
    }

    public function batchSize(): int
    {
        return 150;
    }

    // public function chunkSize(): int
    // {
    //     return 200;
    // }

    public function uniqueBy()
    {
        return ['orgCopCode', 'empCode', 'dateIn', 'shiftType'];
    }

}
