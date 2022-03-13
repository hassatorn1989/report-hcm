<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PayrollImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new PayrollSheet1Import()
        ];
    }

}
