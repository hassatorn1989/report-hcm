<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OrgUnitImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new OrgUnitSheet1Import()
        ];
    }

}
