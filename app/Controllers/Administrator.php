<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Administrator extends BaseController
{
    public function index()
    {
        $data['head'] = 'Dashboard Admin';
        $data['breadcrumb'] = 'Dashboard Admin';
        return view('administrator/dashboard', $data);
    }
}
