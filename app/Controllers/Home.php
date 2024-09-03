<?php

namespace App\Controllers;

use App\Models\ModelUser;
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

        return view('front-page');
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
    function store_register()
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
    function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('shop-login');
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
