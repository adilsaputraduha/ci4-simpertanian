<?php

namespace App\Controllers;

use App\Models\ProfilModel;

class ProfilController extends BaseController
{
    public function index()
    {
        $data['validation'] = \Config\Services::validation();
        echo view('view_profil', $data);
    }

    public function update()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
            'password' => 'required|min_length[4]|max_length[100]',
        ];

        $id = session()->get('userid');

        if ($this->validate($rules)) {
            $model = new ProfilModel();
            $data = array(
                'user_name' => $this->request->getPost('nama'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            );
            $model->updateProfil($data, $id);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to('/logout');
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data gagal diupdate' . $this->validator->listErrors());
            return redirect()->to('/profil')->withInput()->with('validation', $validation);
        }
    }
}
