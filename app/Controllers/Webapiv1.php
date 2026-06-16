<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use Config\GlobalVars;

class Webapiv1 extends BaseController
{

    use ResponseTrait;

    public function periksa_token()
    {

        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            // Alternative fetch method for some apache environments
            $authHeader = $this->request->getHeaderLine('Authorization');
        }

        // Pemisahan Bearer
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {

            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak ada'
            ]);
        }

        try {
            $key = getenv('jwt.encryption.key');
            // Decode the token using firebase/php-jwt (v6+ syntax)
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            // Optional: Pass the decoded payload data into the request object for use in controllers
            return $this->respond([
                    'status'  => 200,
                    'data' => $decoded
            ]);

        } catch (Exception $e) {

            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);

        }
    }


    public function sektor_all()
    {

        // $globalVars = config('GlobalVars');

        $globalVars = new GlobalVars();

        // $myServiceDb = \Config\Services::myServicedb();
        // $db_id = $myServiceDb->getDbGereja();
        print_r($globalVars->db_id);
        // $dbGereja = \Config\Database::connect($db_id, false);

        // $sql = "select sektor_id, no_sektor, nama_sektor from tsektor";
        
        // $query = $dbGereja->query($sql);

        // $data = [];

        // if ($query) {

        //     foreach ($query->$query->getResultArray() as $row) {
        //         array_push($data, [
        //                 "sektor_id"=>$row['sektor_id'], 
        //                 "no_sektor"=>$row['no_sektor'],
        //                 "nama_sektor"=>$row['nama_sektor']
        //             ]
        //         );
        //     }

        //     return $this->respond([
        //         "msg"=>"ok", 
        //         "data"=>$data
        //     ]);

        // } else {

        //     return $this->respond([
        //         "status"=>422, 
        //         "pesan"=>"Error operasi!"
        //     ]);

        // }


    }

}
