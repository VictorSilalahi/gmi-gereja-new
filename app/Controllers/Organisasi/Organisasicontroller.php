<?php

namespace App\Controllers\Organisasi;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

use App\Controllers\BaseController;

class Organisasicontroller extends BaseController
{

    use ResponseTrait;
    

    public function organisasi_all()
    {

        $sql = "select organisasi_id, organisasi from torganisasi";

        $db = $this->set_db();

        $query = $db->query($sql);
        
        if ($query) {

            $results = $query->getResult();

            $data = [];

            foreach($results as $row) {

                array_push($data, array("organisasi_id"=>$row->organisasi_id, "organisasi"=>$row->organisasi));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }

    }

    
    public function organisasi_add()
    {

        $organisasi = $this->request->getPost("nama");

        $sql = "insert into torganisasi (organisasi) values ('".$organisasi."')";

        $db = $this->set_db();

        $db->query($sql);

        // catat log
        $this->catat_log($db, "tambah", "organisasi");
        
        return $this->respond([
                "msg"=>"ok", 
                "data"=>"data organisasi berhasil ditambahkan"
        ]);

    }


    public function organisasi_change()
    {

        $organisasi = $this->request->getPost("nama");
        $organisasi_id = $this->request->getPost("organisasi_id");

        $sql = "update torganisasi set organisasi='".$organisasi."' where organisasi_id=".$organisasi_id;

        $db = $this->set_db();

        $db->query($sql);

        // catat log
        $this->catat_log($db, "ubah", "organisasi");

        return $this->respond([
                "msg"=>"ok", 
                "data"=>"data organisasi berhasil diubah"
        ]);    
    
    }


    public function organisasi_del()
    {

        $organisasi_id = $this->request->getPost("organisasi_id");

        $sql = "select count(*) as jumlah from tanggotaorganisasi where organisasi_id=".$organisasi_id;

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            if ($result->jumlah>0) {

                return $this->respond([
                        "msg"=>"error", 
                        "data"=>"data organisasi tidak bisa dihapus."
                ]);    

            } else {

                $sql = "delete from torganisasi where organisasi_id=".$organisasi_id;

                $db->query($sql);

                // catat log
                $this->catat_log($db, "hapus", "organisasi");

                return $this->respond([
                        "msg"=>"ok", 
                        "data"=>"data organisasi berhasil dihapus"
                ]);  

            }

        }

    }


    public function organisasi_anggota()
    {

        $sql = "select tanggotaorganisasi.anggotaorganisasi_id, tanggotajemaat.nama, torganisasi.organisasi from tanggotaorganisasi, tanggotajemaat, torganisasi ";
        $sql = $sql . "where tanggotaorganisasi.anggotajemaat_id=tanggotajemaat.anggotajemaat_id and tanggotaorganisasi.organisasi_id=torganisasi.organisasi_id";
        $sql = $sql . " group by torganisasi.organisasi";

        // echo($sql);

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $data = [];

            $result = $query->getResult();

            foreach($result as $row) {

                array_push($data, array(
                        "anggotaorganisasi_id"=>$row->anggotaorganisasi_id,
                        "nama"=>$row->nama,
                        "organisasi"=>$row->organisasi
                    )
                );

            }

            return $this->respond([
                    "msg"=>"ok", 
                    "data"=>$data
            ]);  

        }


    }


    public function organisasi_anggota_add()
    {

        $nama = $this->request->getPost("nama");
        $organisasi_id = $this->request->getPost("organisasi_id");

        $sql = "select anggotajemaat_id from tanggotajemaat where nama='".$nama."'";

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $sql = "insert into tanggotaorganisasi (anggotajemaat_id, organisasi_id) values (".$result->anggotajemaat_id.",".$organisasi_id.")";

            $db->query($sql);

            // catat log
            $this->catat_log($db, "tambah", "anggota-organisasi");

            return $this->respond([
                    "msg"=>"ok", 
                    "data"=>"data anggota organisasi berhasil diinput."
            ]);  


        }

    }    


    public function organisasi_anggota_del()
    {

        $anggotaorganisasi_id = $this->request->getPost("anggotaorganisasi_id");

        $sql = "delete from tanggotaorganisasi where anggotaorganisasi_id=".$anggotaorganisasi_id;

        $db = $this->set_db();

        $query = $db->query($sql);

        // catat log
        $this->catat_log($db, "hapus", "anggota-organisasi");

        return $this->respond([
                    "msg"=>"ok", 
                    "data"=>"data anggota organisasi berhasil dihapus."
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