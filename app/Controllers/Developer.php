<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Produk;
use App\Models\Stok;
use CodeIgniter\HTTP\ResponseInterface;

class Developer extends BaseController
{
    public function index()
    {
        //
    }
    function update_stok_admin()
    {
        $produk = new Produk();
        $stok = new Stok();
    }
}
