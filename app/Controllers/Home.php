<?php

namespace App\Controllers;

use App\Models\FotoProduk;
use App\Models\ModelUser;
use App\Models\Produk;
use App\Models\Stok;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        return view('welcome_message');
    }
    public function front_page()
    {
        $produk = new Produk();
        $foto = new FotoProduk();
        $stok = new Stok();
        // new produk
        $get_produk = $produk->where('nama_produk!=', '-')->orderBy('created_at', 'DESC')->findAll();
        foreach ($get_produk as $key => $value) {
            $result[] = $value;
            $value->{'foto_produk'} = $foto->where('id_produk', $value->id_produk)->findAll();
            $value->{'harga'} = $stok->where('id_produk', $value->id_produk)->orderBy('created_at', 'ASC')->first();
        }
        // return $this->respond($result, 200);
        // exit;
        $data['produk'] = $result;
        return view('pelanggan/front-pelanggan', $data);
    }
    public function detail_produk($id_produk)
    {
        $produk = new Produk();
        $foto = new FotoProduk();
        $stok = new Stok();
        $produk = $produk->where('id_produk', $id_produk)->first();
        $produk->{'foto_produk'} = $foto->where('id_produk', $id_produk)->findAll();
        $produk->{'stok_detail'} = $stok->where('id_produk', $id_produk)->orderBy('created_at', 'ASC')->first();
        // $produk->{'count_stok'} = $stok->where('id_produk', $id_produk)->selectSum('stok');
        $response = [
            'status' => 'success',
            'data' => $produk,
        ];
        return $this->respond($response, 200);
    }
    public function login()
    {
        $data['head'] = 'Login';
        $session = \Config\Services::session();
        if ($session->get('login') === true) {
            if ($session->get('role') == 'administrator') {
                return redirect()->to('/administrator');
            } else {
                return redirect()->to('/');
            }
        } else {
            return view('login', $data);
        }
    }
    public function store_register()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'nama' => 'required',
            'password' => 'required',
        ], [
            'email' => [
                'required' => 'Email tidak boleh kosong',
                'valid_email' => 'Email tidak valid',
            ],
            'nama' => [
                'required' => 'nama tidak boleh kosong',
            ],
            'password' => [
                'required' => 'password tidak boleh kosong',
            ],
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $email = $this->request->getPost('email');
            $password = hash('sha256', $this->request->getPost('password'));
            $u_password = hash('sha256', $this->request->getPost('u_password'));
            if ($password != $u_password) {
                $response = [
                    'status' => 'password_not_same',
                    'message' => 'password tidak sama',
                ];
            } else {
                $user = new ModelUser();
                $get_email = $user->where('email', $email)->first();
                if ($get_email == null) {
                    $store = [
                        'nama_user' => $this->request->getPost('nama'),
                        'email' => $email,
                        'profil_status' => 'nonaktif',
                        'password' => $password,
                        'role' => 'pelanggan',
                        'last_login' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $insert = $user->insert($store);
                    $response = [
                        'status' => 'success',
                        'message' => 'pendaftaran berhasil',
                    ];
                } else {
                    $response = [
                        'status' => 'already_exist',
                        'message' => 'email sudah terdaftar',
                    ];
                }
            }
        }
        return $this->respond($response, 200);
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/');
    }
    public function register()
    {
        $data['head'] = "Daftar Akun Baru";
        return view('register', $data);
    }
    // use for verification login by admin
    public function verification()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required',
        ], [
            'email' => [
                'required' => 'Email tidak boleh kosong',
                'valid_email' => 'Email tidak valid',
            ],
            'password' => [
                'required' => 'password tidak boleh kosong',
            ],
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $email = $this->request->getPost('email');
            $password = hash('sha256', $this->request->getPost('password'));
            $user = new ModelUser();
            $get_email = $user->where('email', $email)->first();
            if ($get_email == null) {
                $response = [
                    'status' => 'email_not_found',
                    'message' => 'email tidak ditemukan',
                ];
            } else {
                $get_email = $user->where('email', $get_email->email)->where('password', $password)->first();
                if ($get_email) {
                    $session = \Config\Services::session();
                    $new_session = [
                        'login' => true,
                        'email' => $get_email->email,
                        'id' => $get_email->id,
                        'nama_user' => $get_email->nama_user,
                        'role' => $get_email->role,
                        'profil_status' => $get_email->profil_status,
                    ];
                    $session->set($new_session);
                    $response = [
                        'status' => 'success',
                        'message' => 'login berhasil',
                    ];
                } else {
                    $response = [
                        'status' => 'password_not_same',
                        'message' => 'password tidak sama',
                    ];
                }
            }
        }
        return $this->respond($response, 200);
    }
}
