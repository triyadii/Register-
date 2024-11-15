<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_akun extends Model
{
    protected $table                = 'tbl_akun';
    protected $primaryKey           = 'idAkun';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['username', 'password', 'hakAkses'];
}
