<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_operator extends Model
{
    protected $table                = 'tbl_operator';
    protected $primaryKey           = 'idOperator';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['akun', 'event', 'namaOperator', 'nomorTeleponOperator', 'alamatOperator'];
}
