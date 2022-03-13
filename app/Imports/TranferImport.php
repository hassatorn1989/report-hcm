<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TranferImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TranferSheet1Import()
        ];
    }

}
