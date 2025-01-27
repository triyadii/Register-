<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_log;
use App\Models\Model_data;
use App\Models\Model_penjaga_stand;

class Stand extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData        = new Model_data;
        $dataPenjaga     = $modelData->tampilSeluruhPenjaga();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Penjaga Stand",
            'data'      => $dataPenjaga
        ];
        return $this->respond($response, 200);
    }
    public function cekBarcodePenjagaBooth($idPenjagaStand)
    {
        $modelData        = new Model_data;
        $dataPenjaga     = $modelData->cekPenjagaStand($idPenjagaStand);
        if ($dataPenjaga == null) {
            $response = [
                'status'    => 400,
                'messages'  => "Data Booth Tidak Ditemukan",
                'data'      => $dataPenjaga
            ];
            return $this->respond($response, 400);
        } else {
            $response = [
                'status'    => 200,
                'messages'  => "Data Booth Ditemukan",
                'data'      => $dataPenjaga
            ];
            return $this->respond($response, 200);
        }
    }
    public function create()
    {
        $modelStandPenjaga      = new Model_penjaga_stand();
        $modelLog               = new Model_log;
        $usernameAkses          = $this->request->getVar('usernameAkses');
        $user1                  = $this->request->getVar('user1');
        $user2                  = $this->request->getVar('user2');
        $user3                  = $this->request->getVar('user3');
        $perusahaan             = $this->request->getVar('perusahaan');
        $user = [
            "user1" => $user1,
            "user2" => $user2,
            "user3" => $user3,
        ];
        for ($i = 1; $i <= 3; $i++) {
            $data = [
                'user'          => $user['user' . $i],
                'perusahaan'    => $perusahaan,
            ];
            $modelStandPenjaga->insert($data);
        }
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil melakukan penambahan Data "
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Penambahan booth berhasil",
        ];
        return $this->respond($response, 200);
    }
    public function updatePenjagaStand($idPenjagaStand = null)
    {
        $modelStandPenjaga      = new Model_penjaga_stand();
        $modelLog               = new Model_log;
        $modelData              = new Model_data;
        $berkasKTP              = $this->request->getFile('berkasKTP');
        $namaBerkasKTP          = $berkasKTP->getRandomName();
        $dataBooth              = $modelData->cekPenjagaStand($idPenjagaStand);
        if ($dataBooth[0]['berkasKTP'] != null) {
            unlink('uploads/stand/' . $dataBooth[0]['berkasKTP']);
        }
        // Pengecekan Apabila Gambar Bukti Bayar Kosong
        $data = [
            'berkasKTP'     => $namaBerkasKTP
        ];
        $modelStandPenjaga->update($idPenjagaStand, $data);
        $berkasKTP->move('uploads/stand/', $namaBerkasKTP);

        $dataLog = [
            'username'      => "validator",
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil melakukan pembaharuan Data "
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Terimakasih, Data anda berhasil di perbarui",
            'data'      => $data
        ];
        return $this->respond($response, 200);
    }
    public function hapus($idPenjaga = null, $usernameAkses = null)
    {
        $modelStandPenjaga  = new Model_penjaga_stand();
        $modelData          = new Model_data;
        $modelLog           = new Model_log;
        $dataBooth          = $modelData->cekPenjagaStand($idPenjaga);
        if ($dataBooth[0]['berkasKTP'] != null) {
            unlink('uploads/stand/' . $dataBooth[0]['berkasKTP']);
        }
        $modelStandPenjaga->delete($idPenjaga);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Penghapusan Peserta"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menghapus Peserta",
        ];
        return $this->respond($response, 200);
    }
}
