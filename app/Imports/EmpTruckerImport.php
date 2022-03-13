<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmpTruckerImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new EmpTruckerSheet1Import()
        ];
    }
}
?>
