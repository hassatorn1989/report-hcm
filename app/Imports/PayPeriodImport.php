<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PayPeriodImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new PayPeriodSheet1Import()
        ];
    }

}
