<?php

namespace App\Imports;

use App\Models\tbt_TimeWorking_hour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// WithChunkReading,
class TimeWorkingSheet1Check implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $count = tbt_TimeWorking_hour::where('dateIn', date('Y-m-d', strtotime($row['tdtei'])))->count();
            if ($count > 0) {
                return "asdasd";
                break;
            }else{
                return "6666";
                break;
            }
        }
    }
}
