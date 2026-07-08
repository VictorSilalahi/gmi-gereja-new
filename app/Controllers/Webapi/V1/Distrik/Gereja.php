<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;


class Gereja extends BaseController
{

    use ResponseTrait;
    

    public function gereja_all()
    {

        $distrik = $this->request->getPost("distrik");

        $sql = "select gereja_id, email, nama_gereja, alamat, kondisi_bangunan, kepemilikan from tgereja where distrik='".$distrik."'";

        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getResult();

            foreach($result as $row) {

                array_push($data, array(
                    "gereja_id"=>$row->gereja_id,
                    "email"=>$row->email,
                    "nama_gereja"=>$row->email,
                    "alamat"=>$row->alamat,
                    "kondisi_bangunan"=>$row->kondisi_bangunan,
                    "kepemilikan"=>$row->kepemilikan
                ));
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);


        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);

        }

    }

    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }


}