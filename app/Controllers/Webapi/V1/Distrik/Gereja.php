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

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
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

            $sql = "select tresort.resort_id, tresort.nama_resort, count(tanggotaresort.anggotaresort_id) as jumlah_gereja from tresort, tanggotaresort where tresort.resort_id=tanggotaresort.resort_id and tresort.distrik_id=".$result->distrik_id." group by tresort.resort_id";

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach($result as $res) {

                    array_push($data, array(
                        "resort_id"=>$res->resort_id,
                        "nama_resort"=>$res->nama_resort,
                        "jumlah_gereja"=>$res->jumlah_gereja
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