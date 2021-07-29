<?php

namespace App\Controllers;

class DaerahController extends BaseController
{
    public function kecamatan()
    {
        if ($this->request->isAJAX()) {
            $cariData = $this->request->getGet('search');
            $dataProvinsi = $this->db->table('table_kecamatan')->LIKE('kecamatan_nama', $cariData)->get();

            if ($dataProvinsi->getNumRows() > 0) {
                $list = [];
                $key = 0;
                foreach ($dataProvinsi->getResultArray() as $row) :
                    $list[$key]['id'] = $row['kecamatan_id'];
                    $list[$key]['text'] = $row['kecamatan_nama'];
                    $key++;
                endforeach;
                echo json_encode($list);
            }
        }
    }

    public function getkelurahan()
    {
        if ($this->request->isAJAX()) {
            $cariData = $this->request->getGet('search');
            $dataProvinsi = $this->db->table('table_kelurahan')->LIKE('kelurahan_nama', $cariData)->get();

            if ($dataProvinsi->getNumRows() > 0) {
                $list = [];
                $key = 0;
                foreach ($dataProvinsi->getResultArray() as $row) :
                    $list[$key]['id'] = $row['kelurahan_id'];
                    $list[$key]['text'] = $row['kelurahan_nama'];
                    $key++;
                endforeach;
                echo json_encode($list);
            }
        }
    }

    public function kelurahan()
    {
        if ($this->request->isAJAX()) {
            $kecamatan = $this->request->getVar('kecamatan');
            $dataKelurahan = $this->db->table('table_kelurahan')->where('kelurahan_kecamatan', $kecamatan)->get();

            $isiData = "";

            foreach ($dataKelurahan->getResultArray() as $row) :
                $isiData .= '<option value="' . $row['kelurahan_id'] . '">' . $row['kelurahan_nama'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isiData
            ];

            echo json_encode($msg);
        }
    }
}
