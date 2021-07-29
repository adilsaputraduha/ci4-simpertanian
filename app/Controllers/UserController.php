<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data = [
            'user' => $model->getUser()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_user', $data);
    }

    public function save()
    {
        $rules = [
            'email' => 'required|max_length[50]|is_unique[table_user.user_email]',
            'nama' => 'required|max_length[100]',
            'password' => 'required|min_length[4]|max_length[100]',
            'level' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = array(
                'user_email' => $this->request->getPost('email'),
                'user_name' => $this->request->getPost('nama'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_level' => $this->request->getPost('level')
            );
            $model->saveUser($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/user');
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }
    }

    public function edit()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
            'password' => 'required|min_length[4]|max_length[100]',
            'level' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = array(
                'user_email' => $this->request->getPost('email'),
                'user_name' => $this->request->getPost('nama'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_level' => $this->request->getPost('level')
            );
            $id = $this->request->getPost('id');
            $model->updateUser($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/user');
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }
    }

    public function delete()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');
        $model->deleteUser($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/user');
    }
}
