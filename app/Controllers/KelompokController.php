<?php

namespace App\Controllers;

use App\Models\DaerahModel;
use App\Models\KelompokModel;

class KelompokController extends BaseController
{
    public function index()
    {
        $model = new KelompokModel();
        $data = [
            'kelompok' => $model->getKelompok()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_kelompok', $data);
    }

    public function save()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
            'tambahkecamatan' => 'required',
            'tambahkelurahan' => 'required',
            'keterangan' => 'required|max_length[100]'
        ];

        if ($this->validate($rules)) {
            $model = new KelompokModel();
            $data = array(
                'kelompok_nama' => $this->request->getPost('nama'),
                'kelompok_kecamatan' => $this->request->getPost('tambahkecamatan'),
                'kelompok_kelurahan' => $this->request->getPost('tambahkelurahan'),
                'kelompok_keterangan' => $this->request->getPost('keterangan')
            );
            $model->saveKelompok($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/kelompok');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/kelompok');
        }
    }

    public function edit()
    {
        $id = $this->request->getPost('editid');

        $rules = [
            'editnama' => 'required|max_length[100]',
            'editkecamatan' . $id => 'required',
            'editkelurahan' . $id => 'required',
            'editketerangan' => 'required|max_length[100]'
        ];

        if ($this->validate($rules)) {
            $model = new KelompokModel();
            $data = array(
                'kelompok_nama' => $this->request->getPost('editnama'),
                'kelompok_kecamatan' => $this->request->getPost('editkecamatan' . $id),
                'kelompok_kelurahan' => $this->request->getPost('editkelurahan' . $id),
                'kelompok_keterangan' => $this->request->getPost('editketerangan')
            );
            $model->updateKelompok($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/kelompok');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/kelompok');
        }
    }

    public function delete()
    {
        $model = new KelompokModel();
        $id = $this->request->getPost('id');
        $model->deleteKelompok($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/kelompok');
    }

    public function report()
    {
        $model = new DaerahModel();
        $data = [
            'kecamatan' => $model->getKecamatan()->getResultArray(),
            'kelurahan' => $model->getKelurahan()->getResultArray()
        ];
        echo view('view_report_kelompok', $data);
    }

    public function cetaksemua()
    {
        $model = new KelompokModel();
        $data = [
            'kelompok' => $model->getKelompok()->getResultArray()
        ];
        return view('report/report_kelompok_semua', $data);
    }

    public function cetakkecamatan()
    {
        $id = $this->request->getPost('kecamatan');

        $model = new KelompokModel();
        $data = [
            'kelompokkecamatan' => $model->getKelompokKecamatan($id)->getResultArray(),
            'namakecamatan' => $model->getKelompokKecamatanNama($id)->getResultArray()
        ];
        return view('report/report_kelompok_kecamatan', $data);
    }

    public function cetakkelurahan()
    {
        $id = $this->request->getPost('kelurahan');

        $model = new KelompokModel();
        $data = [
            'kelompokkelurahan' => $model->getKelompokKelurahan($id)->getResultArray(),
            'namakelurahan' => $model->getKelompokKelurahanNama($id)->getResultArray()
        ];
        return view('report/report_kelompok_kelurahan', $data);
    }

    public function cetakstatus()
    {
        $id = $this->request->getPost('status');

        $model = new KelompokModel();
        $data = [
            'kelompokstatus' => $model->getKelompokStatus($id)->getResultArray(),
            'namastatus' => $id
        ];
        return view('report/report_kelompok_status', $data);
    }
}
