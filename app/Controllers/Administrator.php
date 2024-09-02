<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Administrator extends BaseController
{
    public function index()
    {
        $data['head'] = 'Dashboard Admin';
        $data['breadcrumb'] = 'Dashboard Admin';
        return view('administrator/dashboard', $data);
    }
    public function transaksi()
    {
        $data['head'] = 'Transaksi';
        $data['breadcrumb'] = 'Page Transaksi';
        return view('administrator/transaksi', $data);
    }
}
