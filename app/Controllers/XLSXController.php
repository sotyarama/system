<?php

namespace App\Controllers;

use App\Models\CommonModel;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XLSXController extends BaseController
{
    protected $commonModel;
    protected $spreadsheet;

    protected $drawing;

    protected $writer;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->spreadsheet = new Spreadsheet();
        $this->drawing = new Drawing();
        $this->writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
    }

    public function brandsXLSX()
    {
        $brands = $this->commonModel->selectData('brands');
        $today = date('Ymd');
        $sheet = $this->spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Brand Logo');
        $sheet->setCellValue('B1', 'Brand Name');
        $sheet->setCellValue('C1', 'Brand Slug');

        $startRow = 2;
        $row = $startRow;

        foreach ($brands as $b) {
            ${'drw' . $b->brand_slug} = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            ${'drw' . $b->brand_slug}->setName($b->brand_name);
            ${'drw' . $b->brand_slug}->setDescription($b->brand_slug);
            ${'drw' . $b->brand_slug}->setPath('assets/img/brandslogo/' . $b->brand_logo);
            ${'drw' . $b->brand_slug}->setHeight(100);
            ${'drw' . $b->brand_slug}->setWidth(100);
            ${'drw' . $b->brand_slug}->setOffsetX(10);
            ${'drw' . $b->brand_slug}->setOffsetY(10);
            ${'drw' . $b->brand_slug}->setCoordinates('A' . $row);
            ${'drw' . $b->brand_slug}->setWorksheet($sheet);

            $sheet->setCellValue('B' . $row, $b->brand_name);
            $sheet->setCellValue('C' . $row, $b->brand_slug);

            $sheet->getRowDimension($row)->setRowHeight(100);

            $row++;
        }
        $endRow = $row - 1;


        $sheet->getStyle('A1:C' . $endRow)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:C' . $endRow)->getAlignment()->setVertical('center');
        $sheet->getStyle('A1:C1')->getFill()->setFillType('solid');
        $sheet->getStyle('A1:C1')->getFill()->getStartColor()->setARGB('FFFFFF00');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:C' . $endRow)->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);


        header('Content-Disposition: attachment;filename="all_brands_' . $today . '.xlsx"');
        $this->writer->save('php://output');
        exit();
    }
}
