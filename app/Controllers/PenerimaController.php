<?php

namespace App\Controllers;

use App\Models\PenerimaModel;
use App\Models\BantuanModel;
use App\Models\KelompokModel;

class PenerimaController extends BaseController
{
    public function index()
    {
        $modelpenerima = new PenerimaModel();
        $modelbantuan = new BantuanModel();
        $modelkelompok = new KelompokModel();
        $data = [
            'penerima' => $modelpenerima->getPenerima()->getResultArray(),
            'bantuan' => $modelbantuan->getBantuanFilter()->getResultArray(),
            'kelompok' => $modelkelompok->getKelompok()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_penerima', $data);
    }

    public function save()
    {
        $qtyhidden = $this->request->getPost('qtyhidden');
        $qty = $this->request->getPost('qty');

        if ($qty > $qtyhidden) {
            session()->setFlashdata('failed', 'Data gagal disimpan : *Qty tidak boleh lebih besar!');
            return redirect()->to('/penerima');
        }
        $rules = [
            'kelompok' => 'required',
            'bantuan' => 'required',
            'qty' => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new PenerimaModel();
            $data = array(
                'penerima_kelompok' => $this->request->getPost('idkelompok'),
                'penerima_bantuan' => $this->request->getPost('idbantuan'),
                'penerima_qty' => $this->request->getPost('qty')
            );
            $model->savePenerima($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/penerima');
        } else {
            session()->setFlashdata('failed', 'Data gagal disimpan' . $this->validator->listErrors());
            return redirect()->to('/penerima');
        }
    }

    public function edit()
    {
        $qtyhidden = $this->request->getPost('qtyhidden');
        $qty = $this->request->getPost('qty');

        if ($qty > $qtyhidden) {
            session()->setFlashdata('failed', 'Data gagal disimpan : *Qty tidak boleh lebih besar!');
            return redirect()->to('/penerima');
        }
        $rules = [
            'kelompok' => 'required',
            'bantuan' => 'required',
            'qty' => 'required'
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new PenerimaModel();
            $data = array(
                'penerima_kelompok' => $this->request->getPost('idkelompok'),
                'penerima_bantuan' => $this->request->getPost('idbantuan'),
                'penerima_qty' => $this->request->getPost('qty')
            );
            $model->updatePenerima($data, $id);
            session()->setFlashdata('success', 'Data berhasil diedit');
            return redirect()->to('/penerima');
        } else {
            session()->setFlashdata('failed', 'Data gagal diedit' . $this->validator->listErrors());
            return redirect()->to('/penerima');
        }
    }


    public function delete()
    {
        $model = new PenerimaModel();
        $id = $this->request->getPost('id');
        $model->deletePenerima($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/penerima');
    }

    public function report()
    {
        echo view('view_report_penerima');
    }

    public function cetaksemua()
    {
        $model = new PenerimaModel();
        $data = [
            'penerima' => $model->getPenerima()->getResultArray()
        ];
        return view('report/report_penerima_semua', $data);
    }

    public function cetakbantuan()
    {
        $id = $this->request->getPost('bantuan');

        $model = new PenerimaModel();
        $data = [
            'penerimabantuan' => $model->getPenerimaBantuan($id)->getResultArray(),
            'bantuantotal' => $model->getPenerimaBantuanTotal($id)->getResultArray(),
            'namabantuan' => $model->getPenerimaBantuanNama($id)->getResultArray()
        ];
        return view('report/report_penerima_bantuan', $data);
    }

    public function bantuan()
    {
        if ($this->request->isAJAX()) {
            $cariData = $this->request->getGet('search');
            $dataProvinsi = $this->db->table('table_bantuan')->LIKE('bantuan_nama', $cariData)->get();

            if ($dataProvinsi->getNumRows() > 0) {
                $list = [];
                $key = 0;
                foreach ($dataProvinsi->getResultArray() as $row) :
                    $list[$key]['id'] = $row['bantuan_id'];
                    $list[$key]['text'] = $row['bantuan_nama'];
                    $key++;
                endforeach;
                echo json_encode($list);
            }
        }
    }
}
