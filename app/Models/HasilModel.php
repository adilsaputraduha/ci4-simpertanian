<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    public function getHasil()
    {
        $bulder = $this->db->table('table_hasil')
            ->join('table_pelatihan', 'pelatihan_id = hasil_pelatihan');
        return $bulder->get();
    }
    public function getPelatihan()
    {
        $sql = "SELECT * FROM table_pelatihan JOIN table_kecamatan ON kecamatan_id = pelatihan_kecamatan JOIN table_kelurahan ON kelurahan_id = pelatihan_kelurahan WHERE NOT EXISTS (SELECT * FROM table_hasil WHERE table_pelatihan.pelatihan_id = table_hasil.hasil_pelatihan)";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
    public function saveHasil($data)
    {
        $query = $this->db->table('table_hasil')->insert($data);
        return $query;
    }
    public function updateHasil($data, $id)
    {
        $query = $this->db->table('table_hasil')->update($data, array('hasil_id' => $id));
        return $query;
    }
    public function deleteHasil($id)
    {
        $query = $this->db->table('table_hasil')->delete(array('hasil_id' => $id));
        return $query;
    }
}
