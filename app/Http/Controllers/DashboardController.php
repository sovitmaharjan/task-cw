<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\JsonExport\JsonExportRequest;
use App\Services\ExportService;

class DashboardController extends Controller
{
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function index()
    {
        return view("dashboard");
    }

    public function jsonExport(JsonExportRequest $request)
    {
        $fileContent = file_get_contents($request->file->path());
        $jsonData = json_decode($fileContent, true);
        return $this->exportService->export($jsonData, "user.xlsx");
    }
}
