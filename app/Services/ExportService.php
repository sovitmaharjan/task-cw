<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportService
{
    public function export(mixed $data, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $charNum = ord("A");
        foreach ($data[1] as $key => $value) {
            $sheet->setCellValue(chr($charNum) . 1, $key);
            $charNum++;
        }
        $row = 2;
        foreach ($data as $item) {
            $charNum = ord("A");
            foreach ($item as $key => $value) {
                $sheet->setCellValue(chr($charNum) . $row, $value)->getColumnDimension(chr($charNum))->setAutoSize(true);
                $charNum++;
            }
            $row++;
        }
        $filePath = storage_path($filename);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
