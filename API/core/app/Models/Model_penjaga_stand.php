<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_penjaga_stand extends Model
{
    protected $table                = 'tbl_penjaga_stand';
    protected $primaryKey           = 'idPenjagaStand';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['user', 'perusahaan', 'berkasKTP'];
}
