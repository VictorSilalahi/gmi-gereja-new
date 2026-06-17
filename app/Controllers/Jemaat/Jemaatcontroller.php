<?php

namespace App\Controllers\Jemaat;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;

class Jemaatcontroller extends BaseController
{

    use ResponseTrait;


    public function jemaat_per_sektor()
    {

        $db = $this->set_db();

        $sektor_id = $this->request->getGet("sektor_id");

        $data = [];

        // ambil data jemaat di sektor yg dipilih
        $sql = "select jemaat_id, nik, alamat, mobile_phone, status_keanggotaan from tjemaat where tjemaat.sektor_id=".(int)$sektor_id;
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            foreach($result as $row) {


                $sql = "select anggotajemaat_id, nama, posisi from tanggotajemaat where tanggotajemaat.jemaat_id=".(int)$row->jemaat_id;
                $query = $db->query($sql);

                if ($query) {

                    $jumlah_anggota_keluarga = $query->getNumRows();

                    $result2 = $query->getResult();

                    $keluarga = [];
                    $pasangan = '';

                    foreach($result2 as $row2) {

                        if ($row2->posisi=='Suami') {
                            $pasangan = $row2->nama;
                        }
                    
                    }

                    foreach($result2 as $row2) {

                        if ($row2->posisi=='Istri') {
                                $pasangan = $pasangan."/".$row2->nama;
                        }
                    
                    }
                    
                    array_push($keluarga, array("pasangan"=>$pasangan, "jumlah"=>$jumlah_anggota_keluarga));

                }

                array_push($data, array("jemaat_id"=>$row->jemaat_id, "nik"=>$row->nik, "alamat"=>$row->alamat, "mobile_phone"=>$row->mobile_phone, "status_keanggotaan"=>$row->status_keanggotaan, "keluarga"=>$keluarga));


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

    public function jemaat_del()
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


    public function jemaat_add()
    {

        $db = $this->set_db();

        $no_sektor = $this->request->getPost("no_sektor");
        $nama_sektor = $this->request->getPost("nama_sektor");

        $sql = "insert into tsektor(no_sektor, nama_sektor) values ('".$no_sektor."','".$nama_sektor."')";

        $db->query($sql); 

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Data sektor telah ditambah!"
        ]);
        
    }

    public function jemaat_change()
    {

        $db = $this->set_db();

        $sektor_id = $this->request->getPost("sektor_id");
        $no_sektor = $this->request->getPost("no_sektor");
        $nama_sektor = $this->request->getPost("nama_sektor");

        $sql = "update tsektor set no_sektor='".$no_sektor."', nama_sektor='".$nama_sektor."' where sektor_id=".(int)$sektor_id;

        $db->query($sql); 

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


}
