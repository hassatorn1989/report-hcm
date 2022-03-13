<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MapAccountImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AccountMappingSheet1Import()
        ];
    }

}
