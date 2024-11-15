<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_hak_akses;
use App\Models\Model_log;
use App\Models\Model_data;

class HakAkses extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData              = new Model_data;
        $dataHakAkses     = $modelData->tampilSeluruhHakAkses();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Data Hak Akses",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function create()
    {
        $modelHakAkses    = new Model_hak_akses;
        $modelLog         = new Model_log;
        $modelData        = new Model_data;
        $usernameAkses    = $this->request->getVar('usernameAkses');
        $namaHakAkses     = $this->request->getVar('namaHakAkses');
        $cekNamaHakAkses  = $modelData->cekNamaHakAkses($namaHakAkses);
        if ($cekNamaHakAkses != null) {
            $dataLog = [
                'username'      => $usernameAkses,
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Penambahan Hak Akses gagal karena nama hak akses sudah ada di dalam database"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, Nama hak akses yang di tampilkan sudah tersimpan dalam database",
            ];
            return $this->respond($response, 400);
        }
        $data = [
            'namaHakAkses'   => $namaHakAkses
        ];
        $modelHakAkses->insert($data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil penambahan nama hak akses dengan nama hak akses " . $namaHakAkses
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan penambahan nama hak akses",
            'data'      => $data
        ];
        return $this->respond($response, 200);
    }
    public function edit($idHakAkses = null)
    {
        $modelHakAkses          = new Model_hak_akses;
        $modelLog               = new Model_log;
        $usernameAkses          = $this->request->getVar('usernameAkses');
        $namaHakAkses           = $this->request->getVar('namaHakAkses');
        $data = [
            'namaHakAkses'   => $namaHakAkses
        ];
        $modelHakAkses->update($idHakAkses, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan perubahan nama hak akses dengan nama " . $namaHakAkses
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan perubahan data nama Hak Akses",
        ];
        return $this->respond($response, 200);
    }
    public function hapus($idHakAkses = null, $usernameAkses = null)
    {
        $modelHakAkses  = new Model_hak_akses;
        $modelData      = new Model_data;
        $modelLog       = new Model_log;
        $modelHakAkses->delete($idHakAkses);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Penghapusan hak akses "
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menghapus Hak Akses",
        ];
        return $this->respond($response, 200);
    }
}