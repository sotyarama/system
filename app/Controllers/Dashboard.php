<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'tabTitle' => 'Dashboard',
            'title' => 'Dashboard'
        ];
        return view('dashboards/index', $data);
    }
}
