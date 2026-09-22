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

        $sql = "select gereja_id, email, nama_gereja, alamat, lat, lng, kondisi_bangunan, kepemilikan from tgereja where distrik='".$distrik."'";

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
                    "kepemilikan"=>$row->kepemilikan,
                    "lat"=>$row->lat,
                    "lng"=>$row->lng
                ));
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);


        } else {

            $error = $db->error();    
            log_message('error', 'Query failed: ' . $error['message']);
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);

        }

    }

    public function resort_edit()
    {

        $nama_resort = $this->request->getPost("nama_resort");

        $resort_id = $this->request->getPost("resort_id");

        $db = $this->activate_db();

        $sql = "update tresort set nama_resort='".$nama_resort."' where resort_id=".$resort_id;

        $query = $db->query($sql);
        
        if ($query) {

            return $this->respond([
                "msg"=>"ok", 
                "data"=>""
            ]);

        } else {

                $error = $db->error();    
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

        }


    }


   
    public function resort_add()
    {

        $nama_resort = $this->request->getPost("nama_resort");

        $distrik = $this->request->getPost("distrik");

        $db = $this->activate_db();

        $sql = "select distrik_id from tdistrik where distrik='".$distrik."'";

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getRow();

            $sql = "insert into tresort (nama_resort, distrik_id) values ('".$nama_resort."',".$result->distrik_id.")";

            $query = $db->query($sql);

            if ($query) {

                return $this->respond([
                    "msg"=>"ok", 
                    "data"=>""
                ]);

            } else {

                $error = $db->error();    
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

            }


        }




    }

    public function resort_del()
    {

        $resort_id = $this->request->getPost("resort_id");

        $sql = "delete from tresort where resort_id=".$resort_id;

        $db = $this->activate_db();

        $query = $db->query($sql);

        if ($query) {

            return $this->respond([
                "msg"=>"ok", 
                "data"=>""
            ]);

        } else {

            $error = $db->error();    

            log_message('error', 'Query failed: ' . $error['message']);

            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);

        }

    }

    public function resort_all()
    {

        $distrik = $this->request->getPost("distrik");

        $sql = "select distrik_id from tdistrik where distrik='".$distrik."'";

        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getRow();

            $sql = "select tresort.resort_id, tresort.nama_resort from tresort where tresort.distrik_id=".$result->distrik_id;

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach($result as $res) {

                    $sql = "select count(*) as jumlah_gereja from tanggotaresort where resort_id=".$res->resort_id;

                    $query3 = $db->query($sql);

                    $result3 = $query3->getRow();

                    array_push($data, array(
                        "resort_id"=>$res->resort_id,
                        "nama_resort"=>$res->nama_resort,
                        "jumlah_gereja"=>$result3->jumlah_gereja
                    ));
                }

                return $this->respond([
                    "msg"=>"ok", 
                    "data"=>$data
                ]);


            }

        } else {

            $error = $db->error();    

            log_message('error', 'Query failed: ' . $error['message']);

            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);
        
        }


    }



    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }


}