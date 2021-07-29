<?php

namespace App\Controllers;

use App\Models\BantuanModel;

class BantuanController extends BaseController
{
    public function index()
    {
        $model = new BantuanModel();
        $data = [
            'bantuan' => $model->getBantuan()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_bantuan', $data);
    }

    public function save()
    {
        $rules = [
            'tanggal' => 'required',
            'nama' => 'required|max_length[255]',
            'qty' => 'required|max_length[11]',
            'keterangan' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new BantuanModel();
            $data = array(
                'bantuan_tanggal' => $this->request->getPost('tanggal'),
                'bantuan_nama' => $this->request->getPost('nama'),
                'bantuan_qty' => $this->request->getPost('qty'),
                'bantuan_keterangan' => $this->request->getPost('keterangan')
            );
            $model->saveBantuan($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/bantuan');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/bantuan');
        }
    }

    public function edit()
    {
        $rules = [
            'tanggal' => 'required',
            'nama' => 'required|max_length[255]',
            'qty' => 'required|max_length[11]',
            'keterangan' => 'required'
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new BantuanModel();
            $data = array(
                'bantuan_tanggal' => $this->request->getPost('tanggal'),
                'bantuan_nama' => $this->request->getPost('nama'),
                'bantuan_qty' => $this->request->getPost('qty'),
                'bantuan_keterangan' => $this->request->getPost('keterangan')
            );
            $model->updateBantuan($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/bantuan');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/bantuan');
        }
    }

    public function delete()
    {
        $model = new BantuanModel();
        $id = $this->request->getPost('id');
        $model->deleteBantuan($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/bantuan');
    }

    public function report()
    {
        echo view('view_report_bantuan');
    }

    public function cetaksemua()
    {
        $model = new BantuanModel();
        $data = [
            'bantuan' => $model->getBantuan()->getResultArray()
        ];
        return view('report/report_bantuan_semua', $data);
    }

    public function cetaktanggal()
    {
        $awal = $this->request->getPost('tanggalawal');
        $akhir = $this->request->getPost('tanggalakhir');

        $model = new BantuanModel();
        $data = [
            'bantuan' => $model->getBantuanTanggal($awal, $akhir)->getResultArray(),
            'tanggalawal' => $awal,
            'tanggalakhir' => $akhir
        ];
        return view('report/report_bantuan_tanggal', $data);
    }

    public function cetakstatus()
    {
        $id = $this->request->getPost('status');

        $model = new BantuanModel();
        $data = [
            'bantuan' => $model->getBantuanStatus($id)->getResultArray(),
            'namastatus' => $id
        ];
        return view('report/report_bantuan_status', $data);
    }
}
