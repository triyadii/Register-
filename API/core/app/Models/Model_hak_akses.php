<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_hak_akses extends Model
{
    protected $table                = 'tbl_hak_akses';
    protected $primaryKey           = 'idHakAkses';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['namaHakAkses'];
}
