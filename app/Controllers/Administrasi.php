<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Config\Services;

class Administrasi extends BaseController
{

    use ResponseTrait;


    public function index()
    {
        return view('administrasi/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');

    }

    
    public function validasi() 
    {

        $db = \Config\Database::connect();

        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        
        $query = $db->query("select count(*) as jumlah from tgereja where email='".$email."' and password='".$password."'");

        if ($query) {

            $result = $query->getResultArray();
            
            if ($result[0]['jumlah']==1) 
            {

                $query = $db->query("select gereja_id, nama_gereja, distrik, email, db_id, identity_link from tgereja where email='".$email."' and password='".$password."'");
                $result = $query->getResultArray();

                $key = getenv('jwt.encryption.key');
               

                $iat = time(); // Issued at time
                $exp = $iat + 3600; // Expiration time
                $isi_data = [
                    "gereja_id"=>$result[0]['gereja_id'], 
                    "nama_gereja"=>$result[0]['nama_gereja'], 
                    "distrik"=>$result[0]['distrik'], 
                    "email"=>$result[0]['email'],
                    "db_id"=>$result[0]['db_id'],
                    "identity_link"=>$result[0]['identity_link']
                ];

                $payload = [
                    'iat' => $iat,
                    'exp' => $exp,
                    'data' => $isi_data,
                    'email' => $result[0]["email"]
                ];

                $token = JWT::encode($payload, $key, 'HS256');

                $db->close();

                $session = session();
                $session->set('db_id', $result[0]['db_id']);
                
                return $this->respond([
                    'status'  => 200,
                    'pesan' => 'Login sukses',
                    'token'   => $token
                ]);

                
    
            } else {

                return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Login gagal'
                ]);

            
            }
        } else {

            return $this->respond([
                "status"=>422, 
                "pesan"=>"Error operasi!"
            ]);

        }

    }

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

    public function jemaat() 
    {
        return view('administrasi/jemaat');
    }


    public function sektor() 
    {
        return view('administrasi/sektor');
    }


}
