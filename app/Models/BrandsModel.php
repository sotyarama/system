<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandsModel extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id_brand';
    protected $allowedFields =
    [
        'brand_name',
        'brand_slug',
        'brand_logo',
        'brand_g_company',
        'brand_i_company'
    ];
    protected $useTimestamps = true;

    public function getBrand($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['brand_slug' => $slug])->first();
    }
}
