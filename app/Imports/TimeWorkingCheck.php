<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TimeWorkingCheck implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TimeWorkingSheet1Check()
        ];
    }
}
