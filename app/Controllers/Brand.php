<?php

namespace App\Controllers;

use App\Models\CommonModel;

class Brand extends BaseController
{
    protected $commonModel;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public function allbrands()
    {
        $data = [
            'tabTitle'  => 'All Brands',
            'brands'    => $this->commonModel->selectData('brands'),
            'dataTables' => 'yes'
        ];
        return view('brands/all_brands', $data);
    }
}
