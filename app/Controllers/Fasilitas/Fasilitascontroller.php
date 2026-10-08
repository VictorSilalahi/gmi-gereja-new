<?php

namespace App\Controllers\Fasilitas;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

use App\Controllers\BaseController;


class Fasilitascontroller extends BaseController
{

    use ResponseTrait;

    public function fasilitas()
    {
        $session = session();
        // $identity_link = $this->request->getPost("identity_link");

        $identity_link = $session->get('identity_link');
        $sql = "select Gedung_Gereja, Pastori, Gedung_Sekolah_Minggu, Sekolah, Gedung_Serba_Guna, Lahan_Kosong, Pemakaman from tgereja where identity_link='".$identity_link."'";
        // echo($sql);
        // $db = $this->set_db();

        $db = \Config\Database::connect();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $data = [];

            $data['Gedung_Gereja'] = $result->Gedung_Gereja;
            $data['Pastori'] = $result->Pastori;
            $data['Gedung_Sekolah_Minggu'] = $result->Gedung_Sekolah_Minggu;
            $data['Sekolah'] = $result->Sekolah;
            $data['Gedung_Serba_Guna'] = $result->Gedung_Serba_Guna;
            $data['Lahan_Kosong'] = $result->Lahan_Kosong;
            $data['Pemakaman'] = $result->Pemakaman;

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