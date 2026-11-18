<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;
use Exception;

use App\Controllers\BaseController;


class Pekerja extends BaseController
{

    use ResponseTrait;
    
    public function pekerja_add()
    {
        
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $mobile_phone = $this->request->getPost("mobile_phone");
        $tanggal_lahir = $this->request->getPost("tanggal_lahir");
        $tanggal_diterima = $this->request->getPost("tanggal_diterima");
        $tanggal_tahbis = $this->request->getPost("tanggal_tahbis");
        $status = $this->request->getPost("status");
        $penempatan = $this->request->getPost("penempatan");
        $tanggal_sk = $this->request->getPost("tanggal_sk");

        $db = $this->activate_db();

        $sql = '';

        if ($tanggal_tahbis!='') {

            $sql = "insert into tpekerja (nama, email, mobile_phone, tanggal_lahir, tanggal_diterima, tanggal_tahbis, status, penempatan, tanggal_sk) values ";
            $sql = $sql." ('".$nama."','".$email."','".$mobile_phone."','".$tanggal_lahir."','".$tanggal_diterima."','".$tanggal_tahbis."','".$status."','".$penempatan."','".$tanggal_sk."')";

        } else {

            $sql = "insert into tpekerja (nama, email, mobile_phone, tanggal_lahir, tanggal_diterima, status, penempatan, tanggal_sk) values ";
            $sql = $sql." ('".$nama."','".$email."','".$mobile_phone."','".$tanggal_lahir."','".$tanggal_diterima."','".$status."','".$penempatan."','".$tanggal_sk."')";

        }

        // echo($sql);
        
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


    function pekerja_all() 
    {

        $db = $this->activate_db();

        $sql = 'select pekerja_id, nama, email, mobile_phone, tanggal_lahir, tanggal_diterima, tanggal_tahbis, status, penempatan, tanggal_sk from tpekerja order by nama';

        // echo($sql);
        
        $query = $db->query($sql);

        if ($query) {

            $data = [];

            $result = $query->getResult();

            foreach($result as $r) {

                $tanggal_sk = date_create($r->tanggal_sk);
                $tanggal_sekarang = Time::now();
                $interval = date_diff($tanggal_sk, $tanggal_sekarang);

                array_push($data, array(
                    "pekerja_id"=>$r->pekerja_id,
                    "nama"=>$r->nama,
                    "email"=>$r->email,
                    "mobile_phone"=>$r->mobile_phone,
                    "tanggal_lahir"=>$r->tanggal_lahir,
                    "tanggal_diterima"=>$r->tanggal_diterima,
                    "tanggal_tahbis"=>$r->tanggal_tahbis,
                    "status"=>$r->status,
                    "penempatan"=>$r->penempatan,
                    "lama_bekerja"=>$interval,
                    "tanggal_sk"=>$r->tanggal_sk
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


    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }
}