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

    public function fasilitas_ubah()
    {

        $session = session();

        $identity_link = $session->get('identity_link');
        $field_name = $this->request->getPost("field_name");
        $nilai = $this->request->getPost("nilai");

        $sql = "update tgereja set ".$field_name."=".$nilai." where identity_link='".$identity_link."'";
        // echo($sql);
        // $db = $this->set_db();

        $db = \Config\Database::connect();

        $query = $db->query($sql);

        if ($query) {

            return $this->respond([
                "msg"=>"ok", 
                "data"=>""
            ]);
            
        }

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