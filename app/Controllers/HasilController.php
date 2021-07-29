<?php

namespace App\Controllers;

use App\Models\HasilModel;
use App\Models\PelatihanModel;

class HasilController extends BaseController
{
    public function index()
    {
        $modelhasil = new HasilModel();
        $data = [
            'hasil' => $modelhasil->getHasil()->getResultArray(),
            'pelatihan' => $modelhasil->getPelatihan(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_hasil', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('idagenda');
        $rules = [
            'idagenda' => 'required',
            'keterangan' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new HasilModel();
            $model1 = new PelatihanModel();
            $data = array(
                'hasil_pelatihan' => $this->request->getPost('idagenda'),
                'hasil_status' => $this->request->getPost('keterangan')
            );
            $data1 = array(
                'pelatihan_hasil' => $this->request->getPost('keterangan')
            );
            $model->saveHasil($data);
            $model1->updatePelatihan($data1, $id);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/hasil');
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/hasil')->withInput()->with('validation', $validation);
        }
    }

    public function edit()
    {
        $idhasil = $this->request->getPost('id');
        $id = $this->request->getPost('idagenda');

        $rules = [
            'idagenda' => 'required',
            'keterangan' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new HasilModel();
            $model1 = new PelatihanModel();
            $data = array(
                'hasil_pelatihan' => $this->request->getPost('idagenda'),
                'hasil_status' => $this->request->getPost('keterangan')
            );
            $data1 = array(
                'pelatihan_hasil' => $this->request->getPost('keterangan')
            );
            $model->updateHasil($data, $idhasil);
            $model1->updatePelatihan($data1, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/hasil');
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/hasil')->withInput()->with('validation', $validation);
        }
    }

    public function delete()
    {
        $model = new HasilModel();
        $model1 = new PelatihanModel();
        $id = $this->request->getPost('id');
        $idpelatihan = $this->request->getPost('idpelatihan');
        $data1 = array(
            'pelatihan_hasil' => 'Belum terlaksana'
        );
        $model->deleteHasil($id);
        $model1->updatePelatihan($data1, $idpelatihan);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/hasil');
    }

    public function report()
    {
        echo view('view_report_hasil');
    }

    public function cetaksemua()
    {
        $model = new HasilModel();
        $data = [
            'hasil' => $model->getHasil()->getResultArray()
        ];
        return view('report/report_hasil_semua', $data);
    }
}
