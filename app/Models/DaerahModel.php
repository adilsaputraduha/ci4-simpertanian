<?php

namespace App\Models;

use CodeIgniter\Model;

class DaerahModel extends Model
{
    public function getKecamatan()
    {
        $bulder = $this->db->table('table_kecamatan');
        return $bulder->get();
    }
    public function getKelurahan()
    {
        $bulder = $this->db->table('table_kelurahan');
        return $bulder->get();
    }
}
