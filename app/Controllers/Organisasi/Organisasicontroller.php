<?php

namespace App\Controllers\Organisasi;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;

class Organisasicontroller extends BaseController
{

    use ResponseTrait;
    

    public function organisasi_all()
    {

        $sql = "select jabatan_id, jabatan from tjabatan";

        $db = $this->set_db();

        $query = $db->query($sql);
        
        if ($query) {

            $results = $query->getResult();

            $data = [];

            foreach($results as $row) {

                array_push($data, array("jabatan_id"=>$row->jabatan_id, "jabatan"=>$row->jabatan));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }

    }

    

    public function set_db()
    {

        $session = session();
        $db_id = $session->get("db_id");

        $db = \Config\Database::connect();
        $db->setDatabase($db_id);

        return $db;

    }

}