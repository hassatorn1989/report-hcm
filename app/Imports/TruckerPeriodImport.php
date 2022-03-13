<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TruckerPeriodImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TruckerPeriodSheet1Import()
        ];
    }
}
?>
