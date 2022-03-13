<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TimeWorkingImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TimeWorkingSheet1Import()
        ];
    }
}
