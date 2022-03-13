<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmpoyeeImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new EmpoyeeSheet1Import()
        ];
    }
}
?>
