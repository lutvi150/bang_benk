<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Transaksi;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
    }
    function checkout()
    {
        $session = \Config\Services::session();
        $transaksi = new Transaksi();
        $keranjang = new Keranjang();
        $produk = new Produk();
        $id_user = $session->get('id');
        $data = $keranjang->where('id_user', $id_user)->findAll();
        $total_harga = $keranjang->where('id_user', $id_user)->selectSum('total_harga')->first();
        $transaksi->insert([
            'id_user' => $id_user,
            'total_harga' => $total_harga->total_harga,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $id_transaksi = $transaksi->getInsertID();
        foreach ($data as $d) {
            $keranjang->update($d->id_keranjang, ['id_transaksi' => $id_transaksi]);
            $stok = new Stok();
            $get_stok = $stok->where('id_stok', $d->id_stok)->first();
            $get_stok->stok = $get_stok->stok_akhir + $d->qty;
            $check_produk = $produk->where('id_produk', $d->id_produk)->first();
            $check_produk->stok = $check_produk->stok - $d->qty;
            $produk->update($d->id_produk, ['stok' => $check_produk->stok]);
            $update_stok = [
                'stok_akhir' => $get_stok->stok_akhir + $d->qty,
                'keuntungan' => $get_stok->keuntungan + (($get_stok->harga_jual - $get_stok->harga_modal) * $d->qty)
            ];
            $stok->update($d->id_stok, $update_stok);
        }
        $response = [
            'status' => 'success',
            'message' => 'Transaksi berhasil',
            'data' => $data,
            'total_harga' => number_format($total_harga->total_harga),
            'item_count' => count($data),
        ];
        return $this->respond($response, 200);
    }
    function keranjang_store()
    {
        $session = \Config\Services::session();
        $stok = new Stok();
        $keranjang = new Keranjang();
        $id_user = $session->get('id');
        $id_produk = $this->request->getPost('id_produk');
        $get_data_stok = $stok->where('id_produk', $id_produk)->orderBy('created_at', 'ASC')->first();
        $check = $keranjang->where(['id_user' => $id_user, 'id_produk' => $id_produk, 'id_stok' => $get_data_stok->id_stok, 'id_transaksi' => 0])->first();
        $qty = $this->request->getPost('qty');
        $count_qty = $qty == null ? 1 : $qty;
        $insert = [
            'id_user' => $id_user,
            'id_produk' => $id_produk,
            'id_stok' => $get_data_stok->id_stok,
            'qty' => $count_qty,
            'harga' => $get_data_stok->harga_jual,
            'id_transaksi' => 0,
            'total_harga' => $count_qty * $get_data_stok->harga_jual,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if ($check) {
            $count_qty = $check->qty + $count_qty;
            $keranjang->update($check->id_keranjang, ['qty' => $count_qty, 'total_harga' => $count_qty * $check->harga]);
            $response = [
                'status' => 'success',
                'message' => 'Jumlah produk sudah di tambah di keranjang',
            ];
        } else {
            $keranjang->insert($insert);
            $response = [
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang'
            ];
        }
        return $this->respond($response, 200);
    }
    function keranjang()
    {
        $session = \Config\Services::session();
        $keranjang = new Keranjang();
        $id_user = $session->get('id');
        // $data = $keranjang->where('id_user', $id_user)->findAll();
        $data = $keranjang->join('table_stok', 'table_keranjang.id_stok = table_stok.id_stok')->join('table_produk', 'table_keranjang.id_produk = table_produk.id_produk')->where('table_keranjang.id_user', $id_user)->where('table_keranjang.id_transaksi', 0)->select('table_keranjang.*, table_stok.harga_jual, table_produk.nama_produk')->findAll();
        $total_harga = $keranjang->where('id_user', $id_user)->where('id_transaksi', 0)->selectSum('total_harga')->first();
        $response = [
            'status' => 'success',
            'data' => $data,
            'total_harga' => number_format($total_harga->total_harga),
            'item_count' => count($data),

        ];
        return $this->respond($response, 200);
    }
}
