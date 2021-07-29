<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaModel extends Model
{
    public function getPenerima()
    {
        $bulder = $this->db->table('table_penerima')
            ->join('table_kelompok', 'kelompok_id = penerima_kelompok')
            ->join('table_bantuan', 'bantuan_id = penerima_bantuan');
        return $bulder->get();
    }
    public function getPenerimaBantuan($id)
    {
        $bulder = $this->db->table('table_penerima')
            ->join('table_kelompok', 'kelompok_id = penerima_kelompok')
            ->join('table_bantuan', 'bantuan_id = penerima_bantuan')
            ->where(['penerima_bantuan' => $id]);
        return $bulder->get();
    }
    public function getPenerimaBantuanTotal($id)
    {
        $bulder = $this->db->table('table_penerima')
            ->select('SUM(penerima_qty) AS qty')
            ->join('table_kelompok', 'kelompok_id = penerima_kelompok')
            ->join('table_bantuan', 'bantuan_id = penerima_bantuan')
            ->where(['penerima_bantuan' => $id]);
        return $bulder->get();
    }
    public function getPenerimaBantuanNama($id)
    {
        $bulder = $this->db->table('table_penerima')
            ->join('table_kelompok', 'kelompok_id = penerima_kelompok')
            ->join('table_bantuan', 'bantuan_id = penerima_bantuan')
            ->where(['penerima_bantuan' => $id])
            ->groupBy('penerima_bantuan');
        return $bulder->get();
    }
    public function savePenerima($data)
    {
        $query = $this->db->table('table_penerima')->insert($data);
        return $query;
    }
    public function updatePenerima($data, $id)
    {
        $query = $this->db->table('table_penerima')->update($data, array('penerima_id' => $id));
        return $query;
    }
    public function deletePenerima($id)
    {
        $query = $this->db->table('table_penerima')->delete(array('penerima_id' => $id));
        return $query;
    }
}
