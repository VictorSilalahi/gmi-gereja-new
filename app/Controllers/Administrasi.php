<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;



class Administrasi extends BaseController
{

    use ResponseTrait;

    
    public function index(): string
    {
        return view('administrasi/login');
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
                $exp = $iat + intval(getenv('jwt.expiration')); // Expiration time
                $isi_sub = [
                    "gereja_id"=>$result[0]['gereja_id'], 
                    "nama_gereja"=>$result[0]['nama_gereja'], 
                    "distrik"=>$result[0]['distrik'], 
                    "email"=>$result[0]['email'],
                    "db_id"=>$result[0]['db_id'],
                    "identity_link"=>$result[0]['identity_link']
                ];

                $payload = [
                    'sub' => $isi_sub,
                    'iat' => $iat,
                    'exp' => $exp,
                    'email' => $result[0]["email"]
                ];

                $token = JWT::encode($payload, $key, 'HS256');

                // echo($token);
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


}
