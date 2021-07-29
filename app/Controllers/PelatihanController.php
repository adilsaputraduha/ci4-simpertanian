<?php

namespace App\Controllers;

use App\Models\PelatihanModel;

class PelatihanController extends BaseController
{
    public function index()
    {
        $model = new PelatihanModel();
        $data = [
            'pelatihan' => $model->getPelatihan()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_pelatihan', $data);
    }

    public function save()
    {
        $rules = [
            'tambahtanggal' => 'required',
            'tambahkecamatan' => 'required',
            'tambahkelurahan' => 'required',
            'tambahagenda' => 'required|max_length[255]'
        ];

        if ($this->validate($rules)) {
            $model = new PelatihanModel();
            $status = 'Belum terlaksana';
            $data = array(
                'pelatihan_tanggal' => $this->request->getPost('tambahtanggal'),
                'pelatihan_kecamatan' => $this->request->getPost('tambahkecamatan'),
                'pelatihan_kelurahan' => $this->request->getPost('tambahkelurahan'),
                'pelatihan_agenda' => $this->request->getPost('tambahagenda'),
                'pelatihan_hasil' => $status
            );
            $model->savePelatihan($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/pelatihan');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/pelatihan');
        }
    }

    public function edit()
    {
        $id = $this->request->getPost('editid');

        $rules = [
            'edittanggal' => 'required',
            'editkecamatan' . $id => 'required',
            'editkelurahan' . $id => 'required',
            'editagenda' => 'required|max_length[255]'
        ];

        if ($this->validate($rules)) {
            $model = new PelatihanModel();
            $status = 'Belum terlaksana';
            $data = array(
                'pelatihan_tanggal' => $this->request->getPost('edittanggal'),
                'pelatihan_kecamatan' => $this->request->getPost('editkecamatan' . $id),
                'pelatihan_kelurahan' => $this->request->getPost('editkelurahan' . $id),
                'pelatihan_agenda' => $this->request->getPost('editagenda')
            );
            $model->updatePelatihan($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/pelatihan');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/pelatihan');
        }
    }

    public function delete()
    {
        $model = new PelatihanModel();
        $id = $this->request->getPost('id');
        $model->deletePelatihan($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/pelatihan');
    }

    public function report()
    {
        echo view('view_report_pelatihan');
    }

    public function cetaksemua()
    {
        $model = new PelatihanModel();
        $data = [
            'pelatihan' => $model->getPelatihan()->getResultArray()
        ];
        return view('report/report_pelatihan_semua', $data);
    }

    public function cetaktanggal()
    {
        $awal = $this->request->getPost('tanggalawal');
        $akhir = $this->request->getPost('tanggalakhir');

        $model = new PelatihanModel();
        $data = [
            'pelatihan' => $model->getPelatihanTanggal($awal, $akhir)->getResultArray(),
            'tanggalawal' => $awal,
            'tanggalakhir' => $akhir
        ];
        return view('report/report_pelatihan_tanggal', $data);
    }

    public function cetakhasil()
    {
        $id = $this->request->getPost('hasil');

        $model = new PelatihanModel();
        $data = [
            'pelatihan' => $model->getPelatihanHasil($id)->getResultArray(),
            'namahasil' => $id
        ];
        return view('report/report_pelatihan_hasil', $data);
    }
}
