<?php

namespace App;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ThemeReader
{
    public function __construct(
        private readonly Worksheet $sheet,
    ) {

    }

    public function ingest(): array
    {
        return $this->sheet->toArray();
    }
}
