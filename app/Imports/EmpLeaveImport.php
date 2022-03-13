<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmpLeaveImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new EmpLeaveSheet1Import()
        ];
    }
}
?>
