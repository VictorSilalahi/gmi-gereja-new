<?php

namespace App\Controllers\Seting;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;


class Setingcontroller extends BaseController
{

    use ResponseTrait;

    public function password_change()
    {

        $password_baru = $this->request->getPost("password_baru");
        $token = $this->request->getPost("token");

        try {

            $key = getenv('jwt.encryption.key');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            $gereja_id = $decoded->data->gereja_id;

            $db = \Config\Database::connect();
            $sql = "update tgereja set password='".$password_baru."' where gereja_id='".$gereja_id."'";

            $db->query($sql);

            return $this->respond([
                    'msg'  => "ok",
                    'pesan' => 'Password berhasil diubah'
            ]);


        } catch (Exception $e) {
            
            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);
        }

    }

}
