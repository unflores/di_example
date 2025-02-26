<?php

namespace App\Test;

use PHPUnit\Framework\TestCase;
use App\ThemeReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ThemeReaderTest extends TestCase
{
    private Worksheet $sheet;
    private ThemeReader $reader;

    protected function setUp(): void
    {
        $spreadsheet = new Spreadsheet();
        $this->sheet = $spreadsheet->getActiveSheet();
        $this->reader = new ThemeReader($this->sheet);

        // Will start at A1, B1
        $testData = [
            ['', ''],
            ['Categories', 'Categorie_ID'],
            ['Emissions GES', 'V0'],
            ['par gaz à effet de serre', 'V0.1']
        ];

        foreach ($testData as $row => $values) {
            $this->sheet->setCellValue('A' . ($row + 1), $values[0]);
            $this->sheet->setCellValue('B' . ($row + 1), $values[1]);
        }
    }

    public function testIngestReadsThemes(): void
    {
        $result = $this->reader->ingest();

        $this->assertCount(2, $result);
        $this->assertEquals([
            [
                'id' => 'V0',
                'code' => 'emissions_ges'
            ],
            [
                'id' => 'V0.1',
                'code' => 'par_gaz_a_effet_de_serre'
            ]
        ], $result);
    }
}
