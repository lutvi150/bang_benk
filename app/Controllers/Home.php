<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
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
}
