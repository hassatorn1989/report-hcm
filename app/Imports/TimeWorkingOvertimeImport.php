<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TimeWorkingOvertimeImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TimeWorkingOvertimeSheet1Import()
        ];
    }
}
