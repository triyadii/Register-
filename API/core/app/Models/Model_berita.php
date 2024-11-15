<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_berita extends Model
{
    protected $table                = 'tbl_berita';
    protected $primaryKey           = 'iBerita';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['tanggalBerita', 'berita'];
}
