<?php

namespace App\Imports;

use App\Models\tbt_EmpLeave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\WithUpserts;

class EmpLeaveSheet1Import implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // // HVAC = Vacation
            if (floatval($row['hvac']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HVAC',
                    'leaveHour' => $row['hvac'],
                    'leaveAmount' => $row['hvaca'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
            // // HHOL = Holiday
            if (floatval($row['hhol']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HHOL',
                    'leaveHour' => $row['hhol'],
                    'leaveAmount' => $row['hhola'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
            // HSCK = Sick leave
            if (floatval($row['hsck']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HSCK',
                    'leaveHour' => $row['hsck'],
                    'leaveAmount' => $row['hscka'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
            // HGPN = Business leave
            if (floatval($row['hgpn']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HGPN',
                    'leaveHour' => $row['hgpn'],
                    'leaveAmount' => $row['hgpna'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
            // HOTH = Other leave
            if (floatval($row['hmat']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HOTH',
                    'leaveHour' => $row['hmat'],
                    'leaveAmount' => $row['hmata'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
            if (floatval($row['hadm']) > 0) {
                tbt_EmpLeave::create([
                    // 'transferDate' => $row['hempw'],
                    'orgCopCode' => $row['hco'],
                    'orgDivCode' => str_pad($row['hdv'], 3, "0", STR_PAD_LEFT),
                    'orgDepCode' => $row['hdp'],
                    'empCode' => $row['hempw'],
                    'year' => $row['hyr'],
                    'period' => $row['hprd'],
                    'round' => $row['hwk'],
                    'accountType' => 'HOTH',
                    'leaveHour' => $row['hadm'],
                    'leaveAmount' => $row['hadma'],
                    'createBy' => Auth::user()->idx,
                ]);
            }
        }
    }
}
