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



    function pekerja()
    {

        $pekerja_id = $this->request->getUri()->getSegment(4);

        $sql = "select nama, email, mobile_phone, tanggal_lahir, tanggal_diterima, tanggal_tahbis, status, penempatan, tanggal_sk from tpekerja where pekerja_id=".$pekerja_id;

        $data = [];

        $db = $this->activate_db();
        
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $data = [
                "nama"=>$result->nama,
                "email"=>$result->email,
                "mobile_phone"=>$result->mobile_phone,
                "tanggal_lahir"=>$result->tanggal_lahir,
                "tanggal_diterima"=>$result->tanggal_diterima,
                "tanggal_tahbis"=>$result->tanggal_tahbis,
                "status"=>$result->status,
                "penempatan"=>$result->penempatan,
                "tanggal_sk"=>$result->tanggal_sk
            ];

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



    function pekerja_del()
    {

        $pekerja_id = $this->request->getPost("pekerja_id");

        $sql = "delete from tpekerja where pekerja_id=".$pekerja_id;

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


    function pekerja_ubah_simpan()
    {

        $pekerja_id = $this->request->getPost("pekerja_id");
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


        $sql = "update tpekerja set nama = '".$nama."',";
        $sql = $sql . "email='".$email."',";
        $sql = $sql . "mobile_phone='".$mobile_phone."',";
        $sql = $sql . "tanggal_lahir='".$tanggal_lahir."',";
        $sql = $sql . "tanggal_diterima='".$tanggal_diterima."',";
        $sql = $sql . "tanggal_tahbis='".$tanggal_tahbis."',";
        $sql = $sql . "status='".$status."',";
        $sql = $sql . "penempatan='".$penempatan."',";
        $sql = $sql . "tanggal_sk='".$tanggal_sk."' ";
        $sql = $sql . "where pekerja_id=".$pekerja_id;

        
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

    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }
}