<?php

namespace App\Controllers;

use App\Models\CommonModel;
use \Mpdf\Mpdf;

class PDFController extends BaseController
{
    protected $commonModel;
    protected $mPDF;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->mPDF = new Mpdf();
    }

    public function brandsPDF()
    {
        $brands = $this->commonModel->selectData('brands');
        $today = date('Ymd');
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>All Brands</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
        
                th,
                td {
                    text-align: left;
                    padding: 8px;
                }
        
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
        
                th {
                    background-color: #4CAF50;
                    color: white;
                }
        
                .imgpdf {
                    width: 50px;
                    height: 50px;
                }
            </style>
        </head>
        <body>
            <h1>All Brands</h1>
            <table>
                <thead>
                    <tr>
                        <th>Brand Logo</th>
                        <th>Brand Name</th>
                        <th>Brand Slug</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($brands as $b) {
            $html .= '<tr>
                        <td><img class="imgpdf" src="data:image/png;base64,' . base64_encode(file_get_contents('assets/img/brandslogo/' . $b->brand_logo)) . '" alt="" width="50"></td>
                        <td>' . $b->brand_name . '</td>
                        <td>' . $b->brand_slug . '</td>
                    </tr>';
        }
        $html .= '</tbody>
            </table>
        </body>
        </html>';

        $this->mPDF->WriteHTML($html);
        $this->mPDF->Output('all_brands_' . $today . '.pdf', 'D');
    }
}
