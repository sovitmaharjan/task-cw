<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\JsonExport\JsonExportRequest;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard");
    }

    public function jsonExport(JsonExportRequest $request)
    {
        $fileContent = file_get_contents($request->file->path());
        $jsonData = json_decode($fileContent, true);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("A1", "name")->getColumnDimension("A")->setAutoSize(true);
        $sheet->setCellValue("B1", "email")->getColumnDimension("B")->setAutoSize(true);
        $sheet->setCellValue("C1", "phone")->getColumnDimension("C")->setAutoSize(true);
        $sheet->setCellValue("D1", "address")->getColumnDimension("D")->setAutoSize(true);
        $row = 2;
        foreach ($jsonData as $item) {
            $sheet->setCellValue("A$row", $item["name"])->getColumnDimension("A")->setAutoSize(true);
            $sheet->setCellValue("B$row", $item["email"])->getColumnDimension("B")->setAutoSize(true);
            $sheet->setCellValue("C$row", $item["phone"])->getColumnDimension("C")->setAutoSize(true);
            $sheet->setCellValue("D$row", $item["address"])->getColumnDimension("D")->setAutoSize(true);
            $row++;
        }
        $filePath = storage_path("user.xlsx");
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
