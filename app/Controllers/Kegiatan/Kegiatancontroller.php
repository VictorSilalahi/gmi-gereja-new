<?php

namespace App\Controllers\Kegiatan;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

use App\Controllers\BaseController;

class Kegiatancontroller extends BaseController
{

    use ResponseTrait;

    public function kegiatan_all()
    {

        $sql = "select kegiatan_id, tanggal, judul_kegiatan from tkegiatan order by kegiatan_id desc";

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            $data = [];

            foreach($result as $row) {

                array_push($data, array(
                    "kegiatan_id"=>$row->kegiatan_id,
                    "tanggal"=> $row->tanggal,
                    "judul_kegiatan"=> $row->judul_kegiatan
                ));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }

    }


    public function kegiatan_add()
    {

        $tanggal = $this->request->getPost("tanggal");
        $judul = $this->request->getPost("judul");
        $deskripsi = $this->request->getPost("deskripsi");

        $sql = "insert into tkegiatan (tanggal, judul_kegiatan, deskripsi) values ('".$tanggal."','".$judul."','".$deskripsi."')";

        $db = $this->set_db();

        $db->query($sql);

        // catat log
        $this->catat_log($db, "tambah", "kegiatan");

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"data kegiatan berhasil diinput"
        ]);


    }


    public function kegiatan_del() 
    {

        $kegiatan_id = $this->request->getPost("kegiatan_id");

        $sql = "delete from tkegiatan where kegiatan_id=".$kegiatan_id;

        $db = $this->set_db();

        $db->query($sql);

        // catat log
        $this->catat_log($db, "hapus", "kegiatan");

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"data kegiatan berhasil dihapus"
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