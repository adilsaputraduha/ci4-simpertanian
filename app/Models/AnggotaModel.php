<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    public function getAnggota()
    {
        $bulder = $this->db->table('table_anggota')
            ->join('table_kelompok', 'kelompok_id = anggota_kelompok');
        return $bulder->get();
    }
    public function getAnggotaKelompok($id)
    {
        $bulder = $this->db->table('table_anggota')
            ->join('table_kelompok', 'kelompok_id = anggota_kelompok')
            ->where(['anggota_kelompok' => $id]);
        return $bulder->get();
    }
    public function getAnggotaKelompokNama($id)
    {
        $bulder = $this->db->table('table_anggota')
            ->join('table_kelompok', 'kelompok_id = anggota_kelompok')
            ->where(['anggota_kelompok' => $id])
            ->groupBy('anggota_kelompok');
        return $bulder->get();
    }
    public function saveAnggota($data)
    {
        $query = $this->db->table('table_anggota')->insert($data);
        return $query;
    }
    public function updateAnggota($data, $id)
    {
        $query = $this->db->table('table_anggota')->update($data, array('anggota_id' => $id));
        return $query;
    }
    public function deleteAnggota($id)
    {
        $query = $this->db->table('table_anggota')->delete(array('anggota_id' => $id));
        return $query;
    }
}
