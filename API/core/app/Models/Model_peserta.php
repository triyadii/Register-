<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_peserta extends Model
{
    protected $table                = 'tbl_peserta';
    protected $primaryKey           = 'idPeserta';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['event', 'akun', 'kodePeserta', 'nikPeserta', 'namaPeserta', 'alamatPesertta', 'nomorTeleponPeserta', 'nomorRekeningPeserta', 'namaRekeningPeserta', 'buktiBayar', 'statusPembayaranPeserta', 'kehadiran', 'foto'];
}
