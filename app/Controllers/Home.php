<?php

namespace App\Controllers;

use App\Models\CommonModel;

class Home extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CommonModel();;
    }

    public function index()
    {
        $country = $this->model->selectData("countries");
        $data['country'] = $country;
        return view('welcome_message', $data);
    }


    public function state()
    {
        $countryID = $this->request->getPost("cId");
        $stateData = $this->model->selectData("states", array("country_id" => $countryID));
        echo json_encode($stateData);
    }


    public function city()
    {
        $stateID = $this->request->getPost("sId");
        $cityData = $this->model->selectData("cities", array("state_id" => $stateID));

        $output = "<option>select city</option>";
        foreach ($cityData as $city) {
            $output .= "<option value='$city->id'>$city->name</option>";
        }
        echo json_encode($output);
    }
}
