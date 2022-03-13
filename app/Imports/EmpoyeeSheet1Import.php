<?php

namespace App\Imports;

use App\Models\tbm_Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class EmpoyeeSheet1Import implements ToModel, WithHeadingRow,  WithBatchInserts, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        return new tbm_Employee([
            'orgCopCode' => $row['emco'],
            'empCode' => $row['emid'],
            'titleNameEN' => (strpos($row['emsnam'], ' ') == true) ? explode(' ', $row['emsnam'])[1] : '-',
            'firstNameEN' => $row['emgnam'],
            'lastNameEN' => (strpos($row['emsnam'], ' ') == true) ? explode(' ', $row['emsnam'])[0] : $row['emsnam'],
            'titleNameTH' => (strpos($row['emstnm'], ' ') == true) ? explode(' ', $row['emstnm'])[1] : '-',
            'firstNameTH' => $row['emgtnm'],
            'lastNameTH' => (strpos($row['emstnm'], ' ') == true) ? explode(' ', $row['emstnm'])[0] : $row['emstnm'],
            'orgDivCode' => str_pad($row['emdv'], 3, "0", STR_PAD_LEFT),
            'orgDepCode' => $row['emdp'],
            'orgJobCode' => $row['emlead'],
            // 'orgLineCode' => $row['emid'],
            'addressLine1' => $row['emadt1'],
            'addressLine2' => $row['emadt2'],
            'addressLine3' => $row['emtwnt'],
            'postCode' => $row['empost'],
            'SSNO' => $row['emssno'],
            'IDCard' => $row['emidno'],
            'mobile' => $row['emtxno'],
            'birthDate' => (strlen($row['embrth']) == 8) ? date('Y-m-d', strtotime($row['embrth'])) : null,
            'dateFr' => (strlen($row['emserv']) == 8) ? date('Y-m-d', strtotime($row['emserv'])) : null,
            'dateSt' => (strlen($row['emhire']) == 8) ? date('Y-m-d', strtotime($row['emhire'])) : null,
            'dateEx' => (strlen($row['emtrmd']) == 8) ? date('Y-m-d', strtotime($row['emtrmd'])) : null,
            'sex' => $row['emsex'],
            'empStatus' => $row['emstat'],
            'levelCode' => $row['emlvl'],
            'positinCode' => $row['emposc'],
            'paymentBank' => $row['embank'],
            'busRate' => ($row['embus'] > 0) ? $row['embus'] : 0,
            'pregnantFlag' => (substr($row['emsp2'], 0, 1) == 'Y') ? 'ท้อง' : 'ไม่ท้อง',
            'religion' => (substr($row['emsp2'], 1, 1) == '1') ? 'พุทธ' : ((substr($row['emsp2'], 1, 1) == '2') ? 'คริสต์' : 'อิสลาม'),
            'nationality' => (substr($row['emsp2'], 2, 2) == 'TH') ? 'Thai' : ((substr($row['emsp2'], 2, 2) == 'BM') ? 'Burmese' : ((substr($row['emsp2'], 2, 2) == 'CM') ? 'Cambodia' : 'Lao')),
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
