<?php

namespace App\Controllers;

use App\Models\CommonModel;
use App\Models\VehiclesModel;

class Vehicle extends BaseController
{
    protected $commonModel;
    protected $vehiclesModel;
    protected $helpers = ['form', 'url', 'validation', 'validation_list_errors'];

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->vehiclesModel = new VehiclesModel();
    }

    public function allvehicles()
    {
        $data = [
            'tabTitle'  => 'All Vehicles',
            'vehicles'    => $this->commonModel->selectData('vehicles'),
            'dataTables' => 'yes'
        ];
        return view('vehicles/all_vehicles', $data);
    }

    public function detailvehicle($slug)
    {
        $data = [
            'tabTitle'  => 'Detail Vehicle',
            'vehicle'     => $this->vehiclesModel->getVehicleData($slug)
        ];

        if (empty($data['vehicle'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Vehicle ' . $slug . ' is not found / not yet registered in our Database');
        }

        return view('vehicles/detail_vehicle', $data);
    }

    public function addvehicle()
    {
        $data = [
            'tabTitle'  => 'Add Vehicle',
            'use_img_preview' => 'yes',
            'brands'    => $this->commonModel->selectData('brands'),
            'series'    => $this->commonModel->selectData('series'),
            'engines'   => $this->commonModel->selectData('engines'),
            'euros'     => $this->commonModel->selectData('euros'),
            'axles'     => $this->commonModel->selectData('axles'),
            'tires'     => $this->commonModel->selectData('tires')
        ];

        return view('vehicles/add_vehicle', $data);
    }

    public function savevehicle()
    {
        // Validation
        if (!$this->validate([
            'vehicle_name'        => [
                'rules'         => 'required|is_unique[vehicles.vehicle_name]',
                'errors'        => [
                    'required'  => 'Vehicle name is required',
                    'is_unique' => 'Vehicle name already registered'
                ]
            ],
            'brand_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Brand is required'
                ]
            ],
            'series_id'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Series is required'
                ]
            ],
            'engine_id'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Engine is required'
                ]
            ],
            'axle_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Axle is required'
                ]
            ],
            'tire_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tire is required'
                ]
            ],
            'vehicle_image' => [
                'rules'         => 'uploaded[vehicle_image]|max_size[vehicle_image,1024]|is_image[vehicle_image]|mime_in[vehicle_image,image/jpg,image/jpeg,image/png]',
                'errors'        => [
                    'uploaded'  => 'Vehicle image is required',
                    'max_size'  => 'Vehicle image size cannot exceed 1MB',
                    'is_image'  => 'Vehicle image must be an image file',
                    'mime_in'   => 'Vehicle image must be in jpg, jpeg, or png format'
                ]
            ]
        ])) {
            return redirect()->to('/addvehicle')->withInput();
        }

        // Get image
        $vehicleImage = $this->request->getFile('vehicle_image');

        //Not upload image
        if ($vehicleImage->getError() == 4) {
            $vehicleImageName = 'default.png';
        } else {
            // Move image to img/vehiclesimage
            $vehicleImage->move('assets/img/vehiclesimage');

            //Get uploaded image name
            $vehicleImageName = $vehicleImage->getName();
        }

        $slug = url_title($this->request->getVar('vehicle_name'), '-', true);

        $data = [
            'vehicle_name'          => $this->request->getVar('vehicle_name'),
            'vehicle_slug'          => $slug,
            'vehicle_img'           => $vehicleImageName,
            'brand_id'              => $this->request->getVar('brand_id'),
            'series_id'             => $this->request->getVar('series_id'),
            'engine_id'             => $this->request->getVar('engine_id'),
            'axle_id'               => $this->request->getVar('axle_id'),
            'tire_id'               => $this->request->getVar('tire_id'),
            'vehicle_description'   => $this->request->getVar('vehicle_description')
        ];

        $this->vehiclesModel->save($data);

        session()->setFlashdata('message', 'New Vehicle has been added successfully');

        return redirect()->to('/allvehicles');
    }

    public function editvehicle($slug)
    {
        $data = [
            'tabTitle'          => 'Edit Vehicle',
            'use_img_preview'   => 'yes',
            'vehicle'           => $this->vehiclesModel->getVehicleData($slug),
            'brands'    => $this->commonModel->selectData('brands'),
            'series'    => $this->commonModel->selectData('series'),
            'engines'   => $this->commonModel->selectData('engines'),
            'euros'     => $this->commonModel->selectData('euros'),
            'axles'     => $this->commonModel->selectData('axles'),
            'tires'     => $this->commonModel->selectData('tires')
        ];

        if (empty($data['vehicle'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Vehicle ' . $slug . ' is not found / not yet registered in our Database');
        }

        return view('vehicles/edit_vehicle', $data);
    }

    public function updatevehicle($slug)
    {
        //Name check
        $oldVehicle = $this->vehiclesModel->getVehicle($slug);
        if ($oldVehicle['vehicle_name'] == $this->request->getVar('vehicle_name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[vehicles.vehicle_name,vehicle_slug,' . $slug . ']';
        }

        //Validation
        if (!$this->validate([
            'vehicle_name'        => [
                'rules'         => $rule_name,
                'errors'        => [
                    'required'  => 'Vehicle name is required',
                    'is_unique' => 'Vehicle name already registered'
                ]
            ],
            'brand_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Brand is required'
                ]
            ],
            'series_id'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Series is required'
                ]
            ],
            'engine_id'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Engine is required'
                ]
            ],
            'axle_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Axle is required'
                ]
            ],
            'tire_id'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tire is required'
                ]
            ],
            'vehicle_image' => [
                'rules'         => 'max_size[vehicle_image,1024]|is_image[vehicle_image]|mime_in[vehicle_image,image/jpg,image/jpeg,image/png]',
                'errors'        => [
                    'max_size'  => 'Vehicle image size cannot exceed 1MB',
                    'is_image'  => 'Vehicle image must be an image file',
                    'mime_in'   => 'Vehicle image must be in jpg, jpeg, or png format'
                ]
            ]
        ])) {
            return redirect()->to('/editvehicle/' . $slug)->withInput();
        }

        // Get image
        $vehicleImage = $this->request->getFile('vehicle_image');

        //Check image
        if ($vehicleImage->getError() == 4) {
            $vehicleImageName = $this->request->getVar('old_vehicle_image');
        } else {
            // Move image to img/vehiclesimage
            $vehicleImage->move('assets/img/vehiclesimage');

            //Get uploaded image name
            $vehicleImageName = $vehicleImage->getName();

            //Delete old image
            unlink('assets/img/vehiclesimage/' . $this->request->getVar('old_vehicle_image'));
        }

        $slug = url_title($this->request->getVar('vehicle_name'), '-', true);

        $data = [
            'id_vehicle'            => $this->request->getVar('id_vehicle'),
            'vehicle_name'          => $this->request->getVar('vehicle_name'),
            'vehicle_slug'          => $slug,
            'vehicle_img'           => $vehicleImageName,
            'brand_id'              => $this->request->getVar('brand_id'),
            'series_id'             => $this->request->getVar('series_id'),
            'engine_id'             => $this->request->getVar('engine_id'),
            'axle_id'               => $this->request->getVar('axle_id'),
            'tire_id'               => $this->request->getVar('tire_id'),
            'vehicle_description'   => $this->request->getVar('vehicle_description')
        ];

        $this->vehiclesModel->save($data);

        session()->setFlashdata('message', $this->request->getVar('vehicle_name') . ' vehicle has been updated successfully');

        return redirect()->to('/allvehicles');
    }

    public function deletevehicle($slug)
    {
        $vehicle = $this->vehiclesModel->getVehicle($slug);

        if ($vehicle['vehicle_img'] != 'default.jpg') {
            unlink('assets/img/vehiclesimage/' . $vehicle['vehicle_img']);
        }

        $this->vehiclesModel->delete($vehicle['id_vehicle']);

        session()->setFlashdata('message', $vehicle['vehicle_name'] . ' vehicle has been deleted successfully');

        return redirect()->to('/allvehicles');
    }

    public function getDataByBrandId($id)
    {
        $seriesData = $this->commonModel->selectData("series", array("brand_id" => $id));
        $engineData = $this->commonModel->selectData("engines", array("brand_id" => $id));

        $data = [
            'series'    => $seriesData,
            'engines'   => $engineData
        ];
        echo json_encode($data);
    }
}
