<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        return view('welcome_message');
    }
    function front_page()  {
        return view('front-page');
    }
    public function login()
    {
        $data['head'] = 'Login';
        return view('login', $data);
    }
    public function register()
    {
        $data['head'] = "Daftar Akun Baru";
        return view('register', $data);
    }
    // use for verification login by admin
    function verification() {

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'email' =>'required|valid_email',
            'password' => 'required',
        ],[
            'email'=>[
                'required'=>'Email tidak boleh kosong',
                'valid_email'=>'Email tidak valid',
            ],[
                'password'=>'Password tidak boleh kosong',
            ]
        ]);
        if ($validation->run($this->request->getVar()) == FALSE) {
            return $this->respond([
                'error' => true,
               'message' => $validation->getErrors(),
            ]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $this->userModel->where('email', $email)->first();
        //     if ($user) {
        //         if (password_verify($password, $user['password'])) {
        //             if ($user['is_active'] == 1) {
        //                 $this->session->set('logged_in', true);
        //                 $this->session->set('user_id', $user['id']);
        //                 $this->session->set('username', $user['username']);
        //                 $this->session->set('email', $user['email']);
        //                 $this->session->set('role', $user['role']);
        //                 return $this->respond([
        //                     'error' => false,
        //                    'message' => 'Login berhasil',
        //                 ]);
        //             } else {
        //                 return $this->respond([
        //                     'error' => true,
        //                    'message' => 'Akun belum diaktifkan',
        //                 ]);
        //             }
        //         } else {
        //             return $this->respond([
        //                 'error' => true,
        //                'message' => 'Password salah',
        //             ]);
        //         }
        //     } else {
        //         return $this->respond([
        //             'error' => true,
        //            'message' => 'Email tidak terdaftar',
        //         ]);
        //     }
        // }
    }
    }}
