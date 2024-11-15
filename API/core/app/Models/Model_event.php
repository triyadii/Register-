<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_event extends Model
{
    protected $table                = 'tbl_event';
    protected $primaryKey           = 'idEvent';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['subdomain', 'namaEvent', 'tanggalEvent', 'tanggalPendaftaranEvent', 'lokasiEvent', 'nomorRekeningEvent', 'namaRekeningEvent', 'nomorRekeningPembayaran', 'namaRekeningPembayaran', 'linkMap', 'linkMateri', 'linkMedia', 'templateSertifikat', 'buktiBayarEvent', 'statusPembayaranEvent', 'statusEvent'];
}
