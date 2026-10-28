<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;
use Exception;

use App\Controllers\BaseController;


class All extends BaseController
{

    use ResponseTrait;
    
    public function distrik_all()
    {


        $data = [];

        $db = $this->activate_db();

        $sql = "select distinct(distrik) as nama from tgereja";

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getResult();

            foreach($result as $r) {

                array_push($data, array(
                        "nama_distrik"=>$r->nama
                ));                

            }

            return $this->respond([
                    "msg"=>"ok", 
                    "data"=>$data
            ]);
            
        }


    }

    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }



}