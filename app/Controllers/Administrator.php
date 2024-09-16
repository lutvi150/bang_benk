<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BuktiBayar;
use App\Models\FotoProduk;
use App\Models\Keranjang;
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
        $data['transaksi'] = $transaksi->join('table_user', 'table_transaksi.id_user = table_user.id')->select('table_transaksi.*, table_user.nama_user,table_user.email')->where('table_transaksi.status_transaksi !=', 'menunggu_pembayaran')->orderBy('id_transaksi', 'DESC')->findAll();
        // return $this->respond($data, 200);
        return view('administrator/transaksi', $data);
    }
    function bukti_pembayaran_view($id_transaksi)
    {
        $buktibayar = new BuktiBayar();
        $check_bukti_bayar = $buktibayar->where('id_transaksi', $id_transaksi)->first();
        $response = [
            'status' => 'success',
            'data' => $check_bukti_bayar,
        ];
        return $this->respond($response, 200);
    }
    function verifikasi_pembayaran()
    {
        $status = $this->request->getPost('status');
        $id_transaksi = $this->request->getPost('id_transaksi');
        $transaksi = new Transaksi();
        if ($status == 1) {
            $update = [
                'status_transaksi' => 'finish'
            ];
            $transaksi->update($id_transaksi, $update);
            $response = [
                'status' => 'success',
                'message' => 'pembayaran berhasil diverifikasi',
            ];
        } else {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'keterangan' => 'required',
            ], [
                'keterangan' => [
                    'required' => 'Keterangan tidak boleh kosong',
                ],
            ]);
            if (!$validation->withRequest($this->request)->run()) {
                $response = [
                    'status' => 'validation_failed',
                    'message' => $validation->getErrors()['keterangan'],
                ];
            } else {
                $update = [
                    'status_transaksi' => 'tolak'
                ];
                $update_bukti_bayar = [
                    'keterangan' => $this->request->getPost('keterangan')
                ];
                $transaksi->update($id_transaksi, $update);
                $bukti_bayar = new BuktiBayar();
                $up_bukti_bayar = $bukti_bayar->set($update_bukti_bayar)->where('id_transaksi', $id_transaksi)->update();
                $response = [
                    'status' => 'success',
                    'message' => 'pembayaran berhasil diverifikasi',
                ];
            }
        }

        return $this->respond($response, 200);
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
        $template = '<table><tr><td>Nama Produk</td><td>Nomor Registrasi</td><td>Barcode</td></tr><tr><td>nama</td><td></td><td><img src="' . base_url() . '.uploads/barcode/barcode_' . 1 . '.png' . '" alt=""></td></tr>"</table>';
        $data['produk'] = $get_produk;
        return $this->respond($template, 200);
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
                $harga_jual = $stok->where('id_produk', $value->id_produk,)->orderBy('created_at', 'DESC')->first();
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
    // search for barcode scan
    function produk_search()
    {
        $session = \Config\Services::session();
        $nomor_registrasi_produk = $this->request->getPost('id_produk');
        $produk = new Produk();
        $stok = new Stok();
        $keranjang = new Keranjang();
        $get_produk = $produk->where('nomor_registrasi_produk', $nomor_registrasi_produk)->first();
        if ($get_produk) {
            $id_user = $session->get('id');
            $id_produk = $get_produk->id_produk;
            $get_data_stok = $stok->where('id_produk', value: $id_produk,)->orderBy('created_at', 'ASC')->first();
            $check = $keranjang->where(['id_user' => $id_user, 'id_produk' => $id_produk, 'id_stok' => $get_data_stok->id_stok, 'id_transaksi' => 0])->first();

            if ($check) {
                $count_qty = $check->qty + 1;
                $keranjang->update($check->id_keranjang, ['qty' => $count_qty, 'total_harga' => $count_qty * $check->harga]);
                $response = [
                    'status' => 'success',
                    'message' => 'Jumlah produk sudah di tambah di keranjang',
                ];
            } else {
                $insert = [
                    'id_user' => $id_user,
                    'id_produk' => $id_produk,
                    'id_stok' => $get_data_stok->id_stok,
                    'qty' => 1,
                    'harga' => $get_data_stok->harga_jual,
                    'id_transaksi' => 0,
                    'total_harga' => 1 * $get_data_stok->harga_jual,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $keranjang->insert($insert);
                $response = [
                    'status' => 'success',
                    'message' => 'Produk berhasil ditambahkan ke keranjang',
                    'data' => $get_produk,
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'produk tidak ditemukan',
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
            'total_harga' => ($total_harga->total_harga),
            'item_count' => count($data),

        ];
        return $this->respond($response, 200);
    }
    function keranjang_update()
    {

        $session = \Config\Services::session();
        $keranjang = new Keranjang();
        $id_keranjang = $this->request->getPost('id_keranjang');
        $qty = $this->request->getPost('qty');
        $check_keranjang = $keranjang->where('id_keranjang', $id_keranjang)->first();
        $total_harga = $check_keranjang->harga * $qty;
        $keranjang->update($id_keranjang, ['qty' => $qty, 'total_harga' => $total_harga]);
        $id_user = $session->get('id');
        $total_harga = $keranjang->where('id_user', $id_user)->where('id_transaksi', 0)->selectSum('total_harga')->first();
        $response = [
            'status' => 'success',
            'total_harga' => $total_harga->total_harga,
        ];
        return $this->respond($response, 200);
    }
    function keranjang_reset()
    {
        $session = \Config\Services::session();
        $id_user = $session->get('id');
        $keranjang = new Keranjang();
        $keranjang->where('id_user', $id_user)->where('id_transaksi', 0)->delete();
        $response = [
            'status' => 'success',
            'message' => 'keranjang berhasil dikosongkan',
        ];
        return $this->respond($response, 200);
    }
    function keranjang_delete($id_keranjang)
    {
        $keranjang = new Keranjang();
        $delete = $keranjang->delete($id_keranjang);
        if ($delete) {
            $response = [
                'status' => 'success',
                'message' => 'produk berhasil dihapus dari keranjang',
            ];
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'produk gagal dihapus dari keranjang',
            ];
        }
        return $this->respond($response, 200);
    }
    function proses_transaksi()
    {
        $session = \Config\Services::session();
        $transaksi = new Transaksi();
        $keranjang = new Keranjang();
        $produk = new Produk();
        $id_user = $session->get('id');
        $data = $keranjang->where('id_user', $id_user)->where('id_transaksi', 0)->findAll();
        $total_harga = $keranjang->where('id_user', $id_user)->where('id_transaksi', 0)->selectSum('total_harga')->first();
        $insert = [
            'id_user' => $id_user,
            'total_harga' => $total_harga->total_harga,
            'nomor_transaksi' => date('ymdhis'),
            'created_at' => date('Y-m-d H:i:s'),
            'status_transaksi' => 'finish',
        ];
        $transaksi->insert($insert);
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
        ];
        return $this->respond($response, 200);
    }
}
