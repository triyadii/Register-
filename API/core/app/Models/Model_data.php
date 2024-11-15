<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_data extends Model
{
    // =========================================================================
    // Manajemen Akun
    // =========================================================================
    public function tampilSeluruhAkun()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_akun');
        $builder->select('*');
        $builder->orderBy('idAkun', 'DESC');
        $builder->join('tbl_hak_akses', 'tbl_hak_akses.idHakAkses = tbl_akun.hakAkses');
        return $builder->get()->getResultArray();
    }
    public function cekUsername($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_akun');
        $builder->select('*');
        $builder->where('username', $username);
        $builder->join('tbl_hak_akses', 'tbl_hak_akses.idHakAkses = tbl_akun.hakAkses');
        return $builder->get()->getResultArray();
    }
    public function cekAkunById($idAkun)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_akun');
        $builder->select('*');
        $builder->where('idAkun', $idAkun);
        $builder->join('tbl_hak_akses', 'tbl_hak_akses.idHakAkses = tbl_akun.hakAkses');
        return $builder->get()->getResultArray();
    }
    public function cekAkunOperator($idAkun)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_operator');
        $builder->select('*');
        $builder->where('akun', $idAkun);
        $builder->join('tbl_akun', 'tbl_akun.idAkun = tbl_operator.akun');
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_operator.event');
        $builder->join('tbl_hak_akses', 'tbl_hak_akses.idHakAkses = tbl_akun.hakAkses');
        return $builder->get()->getResultArray();
    }
    public function cekAkunPeserta($idAkun)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->where('akun', $idAkun);
        $builder->join('tbl_akun', 'tbl_akun.idAkun = tbl_peserta.akun');
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        $builder->join('tbl_hak_akses', 'tbl_hak_akses.idHakAkses = tbl_akun.hakAkses');
        return $builder->get()->getResultArray();
    }
    // =========================================================================
    // Manajemen Hak Akses
    // =========================================================================
    public function tampilSeluruhHakAkses()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_hak_akses');
        $builder->select('*');
        $builder->orderBy('idHakAkses', 'DESC');
        return $builder->get()->getResultArray();
    }
    public function cekNamaHakAkses($namaHakAkses)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_hak_akses');
        $builder->select('*');
        $builder->where('namaHakAkses', $namaHakAkses);
        return $builder->get()->getResultArray();
    }
    // =========================================================================
    // Manajemen Event
    // =========================================================================
    public function tampilSeluruhEvent()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_event');
        $builder->select('*');
        $builder->orderBy('idEvent', 'DESC');
        return $builder->get()->getResultArray();
    }
    public function cekEvent($namaEvent, $tanggalEvent)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_event');
        $builder->select('*');
        $builder->where('namaEvent', $namaEvent);
        $builder->where('tanggalEvent', $tanggalEvent);
        return $builder->get()->getResultArray();
    }
    public function cekEventById($idEvent)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_event');
        $builder->select('*');
        $builder->where('idEvent', $idEvent);
        return $builder->get()->getResultArray();
    }
    public function cekOperator($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_operator');
        $builder->select('*');
        $builder->where('event', $username);
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_operator.event');
        return $builder->get()->getResultArray();
    }
    public function jumlahEvent()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_event');
        $builder->select('*');
        return $builder->countAllResults();
    }
    // =========================================================================
    // Manajemen Peserta
    // =========================================================================
    public function tampilSeluruhPeserta()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->orderBy('idPeserta', 'DESC');
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        return $builder->get()->getResultArray();
    }
    public function tampilPesertaByIdEvent($idEvent)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->where('event', $idEvent);
        $builder->orderBy('idPeserta', 'DESC');
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        return $builder->get()->getResultArray();
    }
    public function cekPeserta($nikPeserta, $event)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->where('event', $event);
        $builder->where('nikPeserta', $nikPeserta);
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        return $builder->get()->getResultArray();
    }
    public function cekUsernamePeserta($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->where('username', $username);
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        return $builder->get()->getResultArray();
    }
    public function cekPesertaByIdPeserta($idPeserta)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        $builder->where('idPeserta', $idPeserta);
        $builder->join('tbl_event', 'tbl_event.idEvent = tbl_peserta.event');
        $builder->join('tbl_akun', 'tbl_akun.idAkun = tbl_peserta.akun');
        return $builder->get()->getResultArray();
    }
    public function jumlahPeserta()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_peserta');
        $builder->select('*');
        return $builder->countAllResults();
    }
}
