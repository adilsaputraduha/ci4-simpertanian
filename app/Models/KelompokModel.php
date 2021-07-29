<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    public function getKelompok()
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan');
        return $bulder->get();
    }
    public function getKelompokKecamatan($id)
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan')
            ->where(['kelompok_kecamatan' => $id]);
        return $bulder->get();
    }
    public function getKelompokKecamatanNama($id)
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan')
            ->where(['kelompok_kecamatan' => $id])
            ->groupBy('kelompok_kecamatan');
        return $bulder->get();
    }
    public function getKelompokKelurahan($id)
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan')
            ->where(['kelompok_kelurahan' => $id]);
        return $bulder->get();
    }
    public function getKelompokKelurahanNama($id)
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan')
            ->where(['kelompok_kelurahan' => $id])
            ->groupBy('kelompok_kelurahan');
        return $bulder->get();
    }
    public function getKelompokStatus($id)
    {
        $bulder = $this->db->table('table_kelompok')
            ->join('table_kecamatan', 'kecamatan_id = kelompok_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = kelompok_kelurahan')
            ->where(['kelompok_keterangan' => $id]);
        return $bulder->get();
    }
    public function saveKelompok($data)
    {
        $query = $this->db->table('table_kelompok')->insert($data);
        return $query;
    }
    public function updateKelompok($data, $id)
    {
        $query = $this->db->table('table_kelompok')->update($data, array('kelompok_id' => $id));
        return $query;
    }
    public function deleteKelompok($id)
    {
        $query = $this->db->table('table_kelompok')->delete(array('kelompok_id' => $id));
        return $query;
    }
}
