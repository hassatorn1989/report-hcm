<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmpRateImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new EmpRateSheet1Import()
        ];
    }

}
