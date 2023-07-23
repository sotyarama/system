<?php

namespace App\Controllers;

use App\Models\CommonModel;
use App\Models\BrandsModel;

use Config\Services;

class Brand extends BaseController
{
    protected $commonModel;
    protected $brandsModel;
    protected $helpers = ['form', 'url', 'validation', 'validation_list_errors'];

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->brandsModel = new BrandsModel();
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

    public function detailbrand($slug)
    {
        $data = [
            'tabTitle'  => 'Detail Brand',
            'brand'     => $this->brandsModel->getBrand($slug)
        ];

        if (empty($data['brand'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Brand ' . $slug . ' is not found / not yet registered in our Database');
        }

        return view('brands/detail_brand', $data);
    }

    public function addbrand()
    {
        $data = [
            'tabTitle'  => 'Add Brand'
        ];

        return view('brands/add_brand', $data);
    }

    public function savebrand()
    {
        // Validation
        if (!$this->validate([
            'brand_name'        => [
                'rules'         => 'required|is_unique[brands.brand_name]',
                'errors'        => [
                    'required'  => 'Brand name is required',
                    'is_unique' => 'Brand name is already registered'
                ]
            ],
            'brand_g_company'   => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Principal is required'
                ]
            ],
            'brand_i_company'   => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Local Company is required'
                ]
            ],
            'brand_logo'        => [
                'rules'         => 'uploaded[brand_logo]|max_size[brand_logo,1024]|is_image[brand_logo]|mime_in[brand_logo,image/jpg,image/jpeg,image/png]',
                'errors'        => [
                    'uploaded'  => 'Logo is required',
                    'max_size'  => 'File size is too big. Max 1MB',
                    'is_image'  => 'File uploaded is not an image',
                    'mime_in'   => 'File uploaded is not an image'
                ]
            ]
        ])) {
            return redirect()->to('/addbrand')->withInput();
        }


        // Get file logo
        $fileLogo = $this->request->getFile('brand_logo');

        //Not upload logo
        if ($fileLogo->getError() == 4) {
            $logoName = 'default.jpg';
        } else {
            // Move file to folder img/brandslogo
            $fileLogo->move('assets/img/brandslogo');

            //Get uploaded logo name
            $logoName = $fileLogo->getName();
        }

        $slug = url_title($this->request->getVar('brand_name'), '-', true);

        $data = [
            'brand_name'        => $this->request->getVar('brand_name'),
            'brand_slug'        => $slug,
            'brand_logo'        => $logoName,
            'brand_g_company'   => $this->request->getVar('brand_g_company'),
            'brand_i_company'   => $this->request->getVar('brand_i_company')
        ];

        $this->brandsModel->save($data);

        session()->setFlashdata('message', 'New Brand has been added successfully');

        return redirect()->to('/allbrands');
    }

    public function editbrand($slug)
    {
        $data = [
            'tabTitle'  => 'Edit Brand',
            'brand'     => $this->brandsModel->getBrand($slug)
        ];

        return view('brands/edit_brand', $data);
    }

    public function updatebrand($slug)
    {
        //Name check
        $oldBrand = $this->brandsModel->getBrand($slug);
        if ($oldBrand['brand_name'] == $this->request->getVar('brand_name')) {
            $ruleName = 'required';
        } else {
            $ruleName = 'required|is_unique[brands.brand_name,brand_slug,' . $slug . ']';
        }

        // Validation
        if (!$this->validate([
            'brand_name'        => [
                'rules'         => $ruleName,
                'errors'        => [
                    'required'  => 'Brand name is required',
                    'is_unique' => 'Brand name is already registered'
                ]
            ],
            'brand_g_company'   => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Principal is required'
                ]
            ],
            'brand_i_company'   => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Local Company is required'
                ]
            ],
            'brand_logo'        => [
                'rules'         => 'max_size[brand_logo,1024]|is_image[brand_logo]|mime_in[brand_logo,image/jpg,image/jpeg,image/png]',
                'errors'        => [
                    'max_size'  => 'File size is too big. Max 1MB',
                    'is_image'  => 'File uploaded is not an image',
                    'mime_in'   => 'File uploaded is not an image'
                ]
            ]
        ])) {
            return redirect()->to('/editbrand/' . $slug)->withInput();
        }

        // Get file logo
        $fileLogo = $this->request->getFile('brand_logo');

        // Check logo
        if ($fileLogo->getError() == 4) {
            $logoName = $this->request->getVar('old_brand_logo');
        } else {
            // Move file to folder img/brandslogo
            $fileLogo->move('assets/img/brandslogo');

            //Get uploaded logo name
            $logoName = $fileLogo->getName();

            // Delete old logo
            unlink('assets/img/brandslogo/' . $this->request->getVar('old_brand_logo'));
        }

        $slug = url_title($this->request->getVar('brand_name'), '-', true);

        $data = [
            'id_brand'          => $this->request->getVar('id_brand'),
            'brand_name'        => $this->request->getVar('brand_name'),
            'brand_slug'        => $slug,
            'brand_logo'        => $logoName,
            'brand_g_company'   => $this->request->getVar('brand_g_company'),
            'brand_i_company'   => $this->request->getVar('brand_i_company')
        ];

        $this->brandsModel->save($data);

        return redirect()->to('/allbrands');
    }

    public function deletebrand($slug)
    {
        $brand = $this->brandsModel->getBrand($slug);

        // Delete logo
        if ($brand['brand_logo'] != 'default.jpg') {
            unlink('assets/img/brandslogo/' . $brand['brand_logo']);
        }

        $this->brandsModel->delete($brand['id_brand']);

        return redirect()->to('/allbrands');
    }
}
