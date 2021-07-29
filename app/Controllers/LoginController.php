<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('userId')) {
            return redirect()->to(base_url('home'));
        }
        echo view('view_login');
    }

    public function ceklogin()
    {
        $model = new LoginModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->cekLogin($email);

        if ($user) {
            if (password_verify($password, $user['user_password'])) {
                session()->set('userid', $user['user_id']);
                session()->set('useremail', $user['user_email']);
                session()->set('username', $user['user_name']);
                session()->set('userlevel', $user['user_level']);
                return redirect()->to('/home');
            } else {
                session()->setFlashdata('failed', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('failed', 'Email tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->remove('userid');
        session()->remove('useremail');
        session()->remove('username');
        session()->remove('userlevel');
        return redirect()->to('/login');
    }
}
