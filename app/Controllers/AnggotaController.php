<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\KelompokModel;

class AnggotaController extends BaseController
{
    public function index()
    {
        $model = new AnggotaModel();
        $model1 = new KelompokModel();
        $data = [
            'kelompok' => $model1->getKelompok()->getResultArray(),
            'anggota' => $model->getAnggota()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_anggota', $data);
    }

    public function save()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
            'jabatan' => 'required|max_length[100]',
            'nik' => 'required|max_length[100]',
            'jenkel' => 'required',
            'idkelompok' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new AnggotaModel();
            $data = array(
                'anggota_nama' => $this->request->getPost('nama'),
                'anggota_jabatan' => $this->request->getPost('jabatan'),
                'anggota_nik' => $this->request->getPost('nik'),
                'anggota_jenkel' => $this->request->getPost('jenkel'),
                'anggota_kelompok' => $this->request->getPost('idkelompok')
            );
            $model->saveAnggota($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/anggota');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/anggota');
        }
    }

    public function edit()
    {
        $rules = [
            'nama' => 'required|max_length[100]',
            'jabatan' => 'required|max_length[100]',
            'nik' => 'required|max_length[100]',
            'jenkel' => 'required',
            'idkelompok' => 'required'
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new AnggotaModel();
            $data = array(
                'anggota_nama' => $this->request->getPost('nama'),
                'anggota_jabatan' => $this->request->getPost('jabatan'),
                'anggota_nik' => $this->request->getPost('nik'),
                'anggota_jenkel' => $this->request->getPost('jenkel'),
                'anggota_kelompok' => $this->request->getPost('idkelompok')
            );
            $model->updateAnggota($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/anggota');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/anggota');
        }
    }

    public function delete()
    {
        $model = new AnggotaModel();
        $id = $this->request->getPost('id');
        $model->deleteAnggota($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/anggota');
    }

    public function report()
    {
        $model = new KelompokModel();
        $data = [
            'kelompok' => $model->getKelompok()->getResultArray()
        ];
        echo view('view_report_anggota', $data);
    }

    public function cetaksemua()
    {
        $model = new AnggotaModel();
        $data = [
            'anggota' => $model->getAnggota()->getResultArray()
        ];
        return view('report/report_anggota_semua', $data);
    }

    public function cetakkelompok()
    {
        $id = $this->request->getPost('kelompok');

        $model = new AnggotaModel();
        $data = [
            'anggotakelompok' => $model->getAnggotaKelompok($id)->getResultArray(),
            'namakelompok' => $model->getAnggotaKelompokNama($id)->getResultArray()
        ];
        return view('report/report_anggota_kelompok', $data);
    }

    public function kelompok()
    {
        if ($this->request->isAJAX()) {
            $cariData = $this->request->getGet('search');
            $dataProvinsi = $this->db->table('table_kelompok')->LIKE('kelompok_nama', $cariData)->get();

            if ($dataProvinsi->getNumRows() > 0) {
                $list = [];
                $key = 0;
                foreach ($dataProvinsi->getResultArray() as $row) :
                    $list[$key]['id'] = $row['kelompok_id'];
                    $list[$key]['text'] = $row['kelompok_nama'];
                    $key++;
                endforeach;
                echo json_encode($list);
            }
        }
    }
}
