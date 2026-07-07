<?php

namespace App\Controllers\Sektor;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

use App\Controllers\BaseController;

class Sektorcontroller extends BaseController
{

    use ResponseTrait;

    public function sektor_all()
    {

        $db = $this->set_db();

        $sql = "select sektor_id, no_sektor, nama_sektor from tsektor";
        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $results = $query->getResult(); 

            foreach ($results as $row) {
                array_push($data, [
                        "sektor_id"=>$row->sektor_id, 
                        "no_sektor"=>$row->no_sektor,
                        "nama_sektor"=>$row->nama_sektor
                    ]
                );
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        } else {

            return $this->respond([
                "status"=>422, 
                "pesan"=>"Error operasi!"
            ]);

        }


    }


    public function sektor_del()
    {

        $db = $this->set_db();

        $sektor_id = $this->request->getPost("sektor_id");

        // periksa apakah sektor_id udah dipakai di data jemaat
        $sql = "select count(*) as jumlah from tjemaat where tjemaat.sektor_id=".(int)$sektor_id;
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow(); 
            if (isset($result)) {

                if ($result->jumlah>0) {

                    return $this->respond([
                        "msg"=>"error", 
                        "data"=>"Data sektor sudah terpakai!"
                    ]);

                } else {

                    $sql = "delete from tsektor where sektor_id=".$sektor_id;

                    $db->query($sql); 

                    // catat log
                    $this->catat_log($db, "hapus", "sektor");

                    return $this->respond([
                        "msg"=>"ok", 
                        "data"=>"Data sektor tidak terpakai!"
                    ]);

                }

            }

        } else {

            return $this->respond([
                "status"=>422, 
                "pesan"=>"Error operasi!"
            ]);


        }


    }


    public function sektor_add()
    {

        $db = $this->set_db();

        $no_sektor = $this->request->getPost("no_sektor");
        $nama_sektor = $this->request->getPost("nama_sektor");

        $sql = "insert into tsektor(no_sektor, nama_sektor) values ('".$no_sektor."','".$nama_sektor."')";

        $db->query($sql); 

        // catat log
        $this->catat_log($db, "tambah", "sektor");

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Data sektor telah ditambah!"
        ]);
        
    }

    public function sektor_change()
    {

        $db = $this->set_db();

        $sektor_id = $this->request->getPost("sektor_id");
        $no_sektor = $this->request->getPost("no_sektor");
        $nama_sektor = $this->request->getPost("nama_sektor");

        $sql = "update tsektor set no_sektor='".$no_sektor."', nama_sektor='".$nama_sektor."' where sektor_id=".(int)$sektor_id;

        $db->query($sql); 

        // catat log
        $this->catat_log($db, "ubah", "sektor");

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Data sektor telah disimpan!"
        ]);
    
    }


    public function set_db()
    {

        $session = session();
        $db_id = $session->get("db_id");

        $db = \Config\Database::connect();
        $db->setDatabase($db_id);

        return $db;

    }

    public function catat_log($db, $operasi, $tujuan)
    {

        $catatlog = Services::catatlog();
        $catatlog->setDb($db);
        $catatlog->catat($operasi, $tujuan);        

    }

}
