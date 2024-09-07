<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FotoProduk;
use App\Models\ModelUser;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Transaksi;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;

class Administrator extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $produk = new Produk();
        $transaksi = new Transaksi();
        $user = new ModelUser();
        $data['head'] = 'Dashboard Admin';
        $data['breadcrumb'] = 'Dashboard Admin';
        $data['produk'] = $produk->where('nama_produk !=', '-')->countAllResults();
        $data['transaksi'] = $transaksi->countAllResults();
        $data['user'] = $user->countAllResults();
        $data['total_transaksi'] = $transaksi->selectSum('total_harga')->findAll();
        return view('administrator/dashboard', $data);
    }
    // use for gamabr
    public function produk_gambar_upload()
    {
        $id_produk = $this->request->getPost('id_produk');
        $foto = new FotoProduk();
        $file = $this->request->getFile('foto_produk');
        $filename = $id_produk . '_' . date('ymdhis') . '_' . $file->getRandomName();
        $size = $file->getSizeByUnit('kb');
        $ext = $file->guessExtension();
        $validationRule = [
            'foto_produk' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[foto_produk]',
                    'is_image[foto_produk]',
                    'mime_in[foto_produk,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[foto_produk,1000]',
                    // 'max_dims[foto_produk,1024,768]',
                ],
                'errors' => [
                    'uploaded' => 'File tidak terupload',
                    'is_image' => 'File bukan gambar',
                    'mime_in' => 'Ekstensi file tidak sesuai',
                    'max_size' => 'Ukuran file melebihi 100KB',
                    // 'max_dims' => 'Dimensi file melebihi 1024x768',
                ],
            ],
        ];
        if (!$this->validateData([], $validationRule)) {
            $response = [
                'status' => 'validation_failed',
                'message' => $this->validator->getErrors(),
            ];
        } else {
            $file->move(ROOTPATH . 'public/uploads/produk/', $filename);
            $insert = [
                'id_produk' => $id_produk,
                'foto_produk' => $filename,
            ];
            $store = $foto->insert($insert);

            $response = [
                'status' => 'success',
                'message' => 'file berhasil diupload',
                'info' => new File($file),
            ];
        }
        return $this->respond($response, 200);
    }
    public function produk_gambar_delete()
    {
        $foto = new FotoProduk();
        $id_gambar = $this->request->getPost('id_gambar');
        $check_gambar = $foto->where('id_foto_produk', $id_gambar)->first();

        if ($check_gambar) {
            $delete = $foto->delete($id_gambar);
            if ($delete) {
                if (file_exists(ROOTPATH . 'public/uploads/produk/' . $check_gambar->foto_produk)) {
                    unlink(ROOTPATH . 'public/uploads/produk/' . $check_gambar->foto_produk);
                    $response = [
                        'status' => 'success',
                        'message' => 'File berhasil dihapus',
                    ];
                }
                $response = [
                    'status' => 'success',
                    'message' => 'gambar berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'gambar gagal dihapus',
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'gambar tidak ditemukan',
            ];
        }
        return $this->respond($response, 200);
    }
    public function produk_gambar($id_produk)
    {
        $foto = new FotoProduk();
        $foto_produk = $foto->where('id_produk', $id_produk)->findAll();
        $response = [
            'status' => 'success',
            'data' => $foto_produk,
        ];
        return $this->respond($response, 200);
    }
    public function produk_gambar_priview($id)
    {
        $foto = new FotoProduk();
        $foto_produk = $foto->where('id_foto_produk', $id)->first();
        $response = [
            'status' => 'success',
            'data' => $foto_produk,
        ];
        return $this->respond($response, 200);
    }
    // use for user
    public function user()
    {
        $user = new ModelUser();
        $data['head'] = 'User';
        $data['breadcrumb'] = 'Data Pengguna';
        $data['user'] = $user->orderBy('id', 'DESC')->findAll();
        return view('administrator/user', $data);
    }
    // use for transaksi
    public function transaksi()
    {
        $transaksi = new Transaksi();
        $data['head'] = 'Transaksi';
        $data['breadcrumb'] = 'Data Transaksi';
        $data['transaksi'] = $transaksi->join('table_user', 'table_transaksi.id_user = table_user.id')->select('table_transaksi.*, table_user.nama_user,table_user.email')->orderBy('id_transaksi', 'DESC')->findAll();
        // return $this->respond($data, 200);
        return view('administrator/transaksi', $data);
    }
    public function transaksi_manual()
    {
        $data['head'] = 'Transaksi Manual';
        $data['breadcrumb'] = 'Transaksi Manual';
        return view('administrator/transaksi_manual', $data);
    }
    // use for produk
    public function produk_cetak()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $produk = new Produk();
        $mpdf = new \Mpdf\Mpdf();
        $get_produk = $produk->where('nama_produk !=', '-')->findAll();

        foreach ($get_produk as $key => $value) {
            file_put_contents('uploads/barcode/barcode_' . $value->id_produk . '.png', $generator->getBarcode($value->nomor_registrasi_produk, $generator::TYPE_CODE_128));

        }
        $template='<table><tr><td>Nama Produk</td><td>Nomor Registrasi</td><td>Barcode</td></tr><tr><td>nama</td><td></td><td><img src="'.base_url().'.uploads/barcode/barcode_' . 1.'.png'.'" alt=""></td></tr>"</table>';
        $data['produk'] = $get_produk;
        // $mpdf->WriteHTML($template);
        // $mpdf->Output(); //option "D" save fi
    }
    public function produk()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $produk = new Produk();
        $stok = new Stok();
        $data['head'] = 'Produk';
        $data['breadcrumb'] = 'Produk';
        // $data['produk'] = $produk->findAll();
        $get_produk = $produk->where('nama_produk !=', '-')->findAll();
        if ($get_produk) {
            foreach ($get_produk as $key => $value) {
                $barcode = $generator->getBarcode($value->nomor_registrasi_produk, $generator::TYPE_CODE_128);
                $harga_jual = $stok->where('id_produk', $value->id_produk, )->orderBy('created_at', 'DESC')->first();
                $terjual = $stok->where('id_produk', $value->id_produk)->selectSum('stok_akhir')->findAll();
                $result[] = $value;
                $value->{'harga_jual'} = $harga_jual == null ? 0 : $harga_jual->harga_jual;
                $value->{'terjual'} = $terjual[0]->stok_akhir == null ? 0 : $terjual[0]->stok_akhir;
                $value->{'transaksi'} = $this->count_transaksi($value->id_produk);
                $value->{'barcode'} = $barcode;
            }
        }
        $data['produk'] = $result;
        // return $this->respond($data, 200);
        // exit;
        return view('administrator/produk', $data);
    }
    public function count_transaksi($id_produk)
    {
        $stok = new Stok();
        $transaksi = $stok->where('id_produk', $id_produk)->findAll();
        $result = [];
        foreach ($transaksi as $key => $value) {
            $result[] = $value->harga_jual * $value->stok_akhir;
        }
        $sum = array_sum($result);
        return $sum;
    }
    public function produk_add()
    {
        $produk = new Produk();
        $data['head'] = 'Tambah Produk';
        $data['breadcrumb'] = 'Tambah Produk';
        $check_produk = $produk->where('nama_produk', '-')->first();
        $data['type'] = 'add';
        $data['produk'] = (object) ['nama_produk' => '', 'detail_produk' => ''];
        if ($check_produk) {
            $data['id_produk'] = $check_produk->id_produk;
        } else {
            $store = $produk->insert(['nama_produk' => '-']);
            $data['id_produk'] = $produk->insertID();
        }
        return view('administrator/produk_tambah', $data);
    }
    public function produk_store()
    {
        $produk = new Produk();
        $type = $this->request->getPost('type');
        $id_produk = $this->request->getPost('id_produk');
        $update = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'detail_produk' => $this->request->getPost('detail_produk'),
            'nomor_registrasi_produk' => date('ymdhis'),
        ];
        if ($type == 'add') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_produk' => 'required',
                'detail_produk' => 'required',
            ], [
                'nama_produk' => [
                    'required' => 'nama produk tidak boleh kosong',
                ],
                'detail_produk' => [
                    'required' => 'detail produk tidak boleh kosong',
                ],
            ]);
            if (!$validation->withRequest($this->request)->run()) {
                $response = [
                    'status' => 'validation_failed',
                    'message' => $validation->getErrors(),
                ];
            } else {
                $nama_produk = $this->request->getPost('nama_produk');
                $check_produk = $produk->where('nama_produk', $nama_produk)->first();
                if ($check_produk) {
                    $response = [
                        'status' => 'already_exist',
                        'message' => 'nama produk sudah terdaftar',
                    ];
                } else {
                    $store = $produk->update($id_produk, $update);
                    $response = [
                        'status' => 'success',
                        'message' => 'produk berhasil ditambahkan',
                    ];
                }
            }
        } else {
            $store = $produk->update($id_produk, $update);
            $response = [
                'status' => 'success',
                'message' => 'produk berhasil diupdate',
            ];
        }
        return $this->respond($response, 200);
    }
    public function produk_edit($id)
    {
        $produk = new Produk();
        $data['head'] = 'Edit Produk';
        $data['breadcrumb'] = 'Edit Produk';
        $data['produk'] = $produk->where('id_produk', $id)->first();
        $data['type'] = 'edit';
        $data['id_produk'] = $id;
        return view('administrator/produk_tambah', $data);
    }
    public function produk_delete($id)
    {
        $produk = new Produk();
        $delete = $produk->delete($id);
        if ($delete) {
            $response = [
                'status' => 'success',
                'message' => 'produk berhasil dihapus',
            ];
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'produk gagal dihapus',
            ];
        }
        return $this->respond($response, 200);
    }
    public function produk_stok($id)
    {
        $stok = new Stok();
        $data['head'] = 'Stok Produk';
        $data['breadcrumb'] = 'Stok Produk';
        $data['stok'] = $stok->where('id_produk', $id)->findAll();
        $data['id_produk'] = $id;
        return view('administrator/stok', $data);
    }
    public function produk_stok_store($id_produk)
    {
        $stok = new Stok();
        $type = $this->request->getPost('type');
        $stok_awal = $this->request->getPost('stok_awal');
        $id_stok = $this->request->getPost('id_stok');
        $data = [
            'id_produk' => $id_produk,
            'stok_awal' => $stok_awal,
            'harga_modal' => $this->request->getPost('harga_modal'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'created_at' => $this->request->getPost('tanggal_stok'),
        ];
        $validation = \Config\Services::validation();
        $validation->setRules([
            'stok_awal' => 'required|numeric',
            'harga_modal' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'tanggal_stok' => 'required',
        ], [
            'stok_awal' => [
                'required' => 'Stok awal tidak boleh kosong',
                'numeric' => 'Stok awal harus berupa angka',
            ],
            'harga_modal' => [
                'required' => 'Harga modal tidak boleh kosong',
                'numeric' => 'Harga modal harus berupa angka',
            ],
            'harga_jual' => [
                'required' => 'Harga jual tidak boleh kosong',
                'numeric' => 'Harga jual harus berupa angka',
            ],
            'tanggal_stoak' => [
                'required' => 'Tanggal stok tidak boleh kosong',
            ],
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $produk = new Produk();
            $check_produk = $produk->where('id_produk', $id_produk)->first();
            if ($type == 'add') {
                $update_produk = $produk->update($id_produk, ['stok' => $check_produk->stok + $stok_awal]);
                $data['stok_akhir'] = 0;
                $store = $stok->insert($data);
                $response = [
                    'status' => 'success',
                    'message' => 'produk berhasil ditambahkan',
                ];
            } else {
                $stok_lama = $stok->where('id_stok', $id_stok)->first();
                $update_produk = $produk->update($id_produk, ['stok' => ($check_produk->$stok - $stok_lama->stok_awal) + $stok_awal]);
                $data['stok_akhir'] = $stok_lama->stok_akhir;
                $store = $stok->update($id_produk, $data);
                $response = [
                    'status' => 'success',
                    'message' => 'produk berhasil diupdate',
                ];
            }
        }

        return $this->respond($response, 200);
    }
    public function produk_stok_delete($id_stok)
    {
        $stok = new Stok();
        $produk = new Produk();
        $stok_lama = $stok->where('id_stok', $id_stok)->first();
        $check_produk = $produk->where('id_produk', $stok_lama->id_produk)->first();
        $update_produk = $produk->update($stok_lama->id_produk, ['stok' => $check_produk->stok - $stok_lama->stok_awal]);
        $delete = $stok->delete($id_stok);
        if ($delete) {
            $response = [
                'status' => 'success',
                'message' => 'produk berhasil dihapus',
            ];
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'produk gagal dihapus',
            ];
        }
        return $this->respond($response, 200);
    }
    public function produk_stok_edit()
    {
        $stok = new Stok();
        $id_stok = $this->request->getPost('id_stok');
        $check_stok = $stok->where('id_stok', $id_stok)->first();
        $response = [
            'status' => 'success',
            'data' => $check_stok,
        ];
        return $this->respond($response, 200);
    }
}
