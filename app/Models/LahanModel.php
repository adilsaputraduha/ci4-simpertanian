<?php

namespace App\Models;

use CodeIgniter\Model;

class LahanModel extends Model
{
    public function getLahan()
    {
        $bulder = $this->db->table('table_lahan')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan');
        return $bulder->get();
    }
    public function getLahanTotal()
    {
        $bulder = $this->db->table('table_lahan')
            ->select('SUM(lahan_luas) AS luaslahan, SUM(lahan_luas_kosong) AS luaslahankosong');
        return $bulder->get();
    }
    public function getLahanKecamatanTotal($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->select('SUM(lahan_luas) AS luaslahan, SUM(lahan_luas_kosong) AS luaslahankosong')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kecamatan' => $id]);
        return $bulder->get();
    }
    public function getLahanKelurahanTotal($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->select('SUM(lahan_luas) AS luaslahan, SUM(lahan_luas_kosong) AS luaslahankosong')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kelurahan' => $id]);
        return $bulder->get();
    }
    public function getLahanKecamatan($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kecamatan' => $id]);
        return $bulder->get();
    }
    public function getLahanKecamatanNama($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kecamatan' => $id])
            ->groupBy('lahan_kecamatan');;
        return $bulder->get();
    }
    public function getLahanKelurahan($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kelurahan' => $id]);
        return $bulder->get();
    }
    public function getLahanKelurahanNama($id)
    {
        $bulder = $this->db->table('table_lahan')
            ->join('table_kecamatan', 'kecamatan_id = lahan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = lahan_kelurahan')
            ->where(['lahan_kelurahan' => $id])
            ->groupBy('lahan_kelurahan');;
        return $bulder->get();
    }
    public function saveLahan($data)
    {
        $query = $this->db->table('table_lahan')->insert($data);
        return $query;
    }
    public function updateLahan($data, $id)
    {
        $query = $this->db->table('table_lahan')->update($data, array('lahan_id' => $id));
        return $query;
    }
    public function deleteLahan($id)
    {
        $query = $this->db->table('table_lahan')->delete(array('lahan_id' => $id));
        return $query;
    }
}
