<?php

namespace App\Models;

use CodeIgniter\Model;

class BantuanModel extends Model
{
    public function getBantuan()
    {
        $bulder = $this->db->table('table_bantuan');
        return $bulder->get();
    }
    public function getBantuanTanggal($awal, $akhir)
    {
        $bulder = $this->db->table('table_bantuan')
            ->where('bantuan_tanggal >=', $awal)
            ->where('bantuan_tanggal <=', $akhir);
        return $bulder->get();
    }
    public function getBantuanStatus($id)
    {
        $bulder = $this->db->table('table_bantuan')
            ->where(['bantuan_keterangan' => $id]);
        return $bulder->get();
    }
    public function saveBantuan($data)
    {
        $query = $this->db->table('table_bantuan')->insert($data);
        return $query;
    }
    public function updateBantuan($data, $id)
    {
        $query = $this->db->table('table_bantuan')->update($data, array('bantuan_id' => $id));
        return $query;
    }
    public function deleteBantuan($id)
    {
        $query = $this->db->table('table_bantuan')->delete(array('bantuan_id' => $id));
        return $query;
    }
    public function getBantuanFilter()
    {
        $bulder = $this->db->table('table_bantuan')
            ->where(['bantuan_keterangan' => 'Sudah diterima']);
        return $bulder->get();
    }
}
