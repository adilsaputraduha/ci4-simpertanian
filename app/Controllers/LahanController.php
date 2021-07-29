<?php

namespace App\Controllers;

use App\Models\LahanModel;

class LahanController extends BaseController
{
    public function index()
    {
        $model = new LahanModel();
        $data = [
            'lahan' => $model->getLahan()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_lahan', $data);
    }

    public function save()
    {
        $rules = [
            'tambahkecamatan' => 'required',
            'tambahkelurahan' => [
                'rules' => 'required|is_unique[table_lahan.lahan_kelurahan]',
                'errors' => [
                    'required' => 'Kelurahan harus diisi',
                    'is_unique' => 'Kelurahan sudah ada, silahkan pilih yang lain'
                ]
            ],
            'tambahluas' => 'required',
            'tambahlahankosong' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new LahanModel();
            $data = array(
                'lahan_kecamatan' => $this->request->getPost('tambahkecamatan'),
                'lahan_kelurahan' => $this->request->getPost('tambahkelurahan'),
                'lahan_luas' => $this->request->getPost('tambahluas'),
                'lahan_luas_kosong' => $this->request->getPost('tambahlahankosong')
            );
            $model->saveLahan($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/lahan');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/lahan');
        }
    }

    public function edit()
    {
        $id = $this->request->getPost('editid');

        $rules = [
            'editkecamatan' . $id => 'required',
            'editkelurahan' . $id => 'required',
            'editluas' => 'required',
            'editlahankosong' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new LahanModel();
            $data = array(
                'lahan_kecamatan' => $this->request->getPost('editkecamatan' . $id),
                'lahan_kelurahan' => $this->request->getPost('editkelurahan' . $id),
                'lahan_luas' => $this->request->getPost('editluas'),
                'lahan_luas_kosong' => $this->request->getPost('editlahankosong')
            );
            $model->updateLahan($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/lahan');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/lahan');
        }
    }

    public function delete()
    {
        $model = new LahanModel();
        $id = $this->request->getPost('id');
        $model->deleteLahan($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/lahan');
    }

    public function report()
    {
        echo view('view_report_lahan');
    }

    public function cetaksemua()
    {
        $model = new LahanModel();
        $data = [
            'lahan' => $model->getLahan()->getResultArray(),
            'lahantotal' => $model->getLahanTotal()->getResultArray()
        ];
        return view('report/report_lahan_semua', $data);
    }

    public function cetakkecamatan()
    {
        $id = $this->request->getPost('kecamatan');

        $model = new LahanModel();
        $data = [
            'lahankecamatan' => $model->getLahanKecamatan($id)->getResultArray(),
            'namakecamatan' => $model->getLahanKecamatanNama($id)->getResultArray(),
            'lahantotal' => $model->getLahanKecamatanTotal($id)->getResultArray()
        ];
        return view('report/report_lahan_kecamatan', $data);
    }

    public function cetakkelurahan()
    {
        $id = $this->request->getPost('kelurahan');

        $model = new LahanModel();
        $data = [
            'lahankelurahan' => $model->getLahanKelurahan($id)->getResultArray(),
            'namakelurahan' => $model->getLahanKelurahanNama($id)->getResultArray(),
            'lahantotal' => $model->getLahanKelurahanTotal($id)->getResultArray()
        ];
        return view('report/report_lahan_kelurahan', $data);
    }
}
