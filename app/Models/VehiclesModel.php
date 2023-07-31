<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiclesModel extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'id_vehicle';
    protected $allowedFields =
    [
        'vehicle_name',
        'vehicle_slug',
        'vehicle_img',
        'brand_id',
        'series_id',
        'engine_id',
        'euro_id',
        'axle_id',
        'tire_id',
        'vehicle_description'
    ];
    protected $useTimestamps = true;

    public function getVehicle($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['vehicle_slug' => $slug])->first();
    }

    public function getVehicleData($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['vehicle_slug' => $slug])
            ->join('brands', 'brands.id_brand = vehicles.brand_id')
            ->join('series', 'series.id_series = vehicles.series_id')
            ->join('engines', 'engines.id_engine = vehicles.engine_id')
            ->join('euros', 'euros.id_euro = engines.euro_id')
            ->join('axles', 'axles.id_axle = vehicles.axle_id')
            ->join('tires', 'tires.id_tire = vehicles.tire_id')
            ->join('cylinder_config', 'cylinder_config.id_cylinder_config = engines.cylinder_config_id')
            ->first();
    }
}
