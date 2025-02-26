<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\ThemeReader;

$excel_file = __DIR__ . '/../data/2025-02-26-themes-emissions.xlsx';
$spreadsheet = IOFactory::load($excel_file);
$sheet = $spreadsheet->getActiveSheet();

$theme_reader = new ThemeReader(
    $sheet
);

$themes_to_create = $theme_reader->ingest();
echo var_dump($themes_to_create);
