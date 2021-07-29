<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    public function updateProfil($data, $id)
    {
        $query = $this->db->table('table_user')->update($data, array('user_id' => $id));
        return $query;
    }
}
