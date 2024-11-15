<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_data;
use \Firebase\JWT\JWT;

class Log extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData      = new Model_data;
        $dataUser       = $modelData->tampilSeluruhLog();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Log",
            'data'      => $dataUser
        ];
        return $this->respond($response, 200);
    }
}
