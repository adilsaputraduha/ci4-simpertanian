<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanModel extends Model
{
    public function getPelatihan()
    {
        $bulder = $this->db->table('table_pelatihan')
            ->join('table_kecamatan', 'kecamatan_id = pelatihan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = pelatihan_kelurahan');
        return $bulder->get();
    }
    public function getPelatihanTanggal($awal, $akhir)
    {
        $bulder = $this->db->table('table_pelatihan')
            ->join('table_kecamatan', 'kecamatan_id = pelatihan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = pelatihan_kelurahan')
            ->where('pelatihan_tanggal >=', $awal)
            ->where('pelatihan_tanggal <=', $akhir);
        return $bulder->get();
    }
    public function getPelatihanHasil($id)
    {
        $bulder = $this->db->table('table_pelatihan')
            ->join('table_kecamatan', 'kecamatan_id = pelatihan_kecamatan')
            ->join('table_kelurahan', 'kelurahan_id = pelatihan_kelurahan')
            ->where(['pelatihan_hasil' => $id]);
        return $bulder->get();
    }
    public function savePelatihan($data)
    {
        $query = $this->db->table('table_pelatihan')->insert($data);
        return $query;
    }
    public function updatePelatihan($data, $id)
    {
        $query = $this->db->table('table_pelatihan')->update($data, array('pelatihan_id' => $id));
        return $query;
    }
    public function deletePelatihan($id)
    {
        $query = $this->db->table('table_pelatihan')->delete(array('pelatihan_id' => $id));
        return $query;
    }
}
