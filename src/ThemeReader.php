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
        $themes = [];
        foreach ($this->sheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $name = $this->sheet->getCell('A'.$rowIndex)->getValue();
            $id = $this->sheet->getCell('B'.$rowIndex)->getValue();

            if (null !== $id && null !== $name) {
                if ($rowIndex > 2) {
                    $themes[] = [
                        'id' => $id,
                        'code' => $this->sanitizeCode($name),
                    ];
                }
            }
        }

        return $themes;
    }

    private function sanitizeCode(string $code): string {
        $code = iconv('UTF-8', 'ASCII//TRANSLIT', $code);
        $code = strtolower($code);
        $code = str_replace(' ', '_', $code);
        $code = str_replace('(', '', $code);
        $code = str_replace(')', '', $code);
        $code = str_replace('/', '', $code);
        $code = str_replace('\\', '', $code);
        $code = str_replace('.', '', $code);
        $code = str_replace(',', '', $code);

        return $code;
    }
}
