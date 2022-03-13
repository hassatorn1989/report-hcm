<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PaySlipImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new PaySlipSheet1Import()
        ];
    }

}
