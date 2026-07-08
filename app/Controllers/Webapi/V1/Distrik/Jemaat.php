<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;


class Jemaat extends BaseController
{

    use ResponseTrait;
    
    public function jemaat_all()
    {
        
        $distrik = $this->request->getPost("distrik");

        $sql = "select db_id from tgereja where distrik='".$distrik."'";
        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getResult();

            $jumlah_kk = 0;
            $jumlah_jiwa = 0;

            foreach($result as $row) {

                $db = $this->set_db($row->db_id);
    
                // cari jumlah KK
                $sql = "select count(*) as jumlah from tjemaat";
                $result = $db->query($sql);
                $row = $result->getRow();

                $jumlah_kk = $jumlah_kk + $row->jumlah;
                
                // cari jumlah jiwa
                $sql = "select count(*) as jumlah from tanggotajemaat where anggotajemaat_id not in (select anggotajemaat_id from twafat)";
                $result = $db->query($sql);
                $row = $result->getRow();

                $jumlah_jiwa = $jumlah_jiwa + $row->jumlah;

                $golongan_darah = [];

                $sql = "select golongan_darah, pendidikan_terakhir, pekerjaan from tanggotajemaat where anggotajemaat_id not in (select anggotajemaat_id from twafat)";

                $query = $db->query($sql);

                if ($query) {

                    $result = $query->getResult();

                    $gol_A = 0;
                    $gol_B = 0;
                    $gol_AB = 0;
                    $gol_O = 0;

                    $ASN = 0;
                    
                    foreach($result as $row) {

                        // golongan darah
                        if ($row)

                    }

                }
                // golongan darah


            }
            
            $data['jumlah_kk'] = $jumlah_kk;
            $data['jumlah_jiwa'] = $jumlah_jiwa;


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



    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }

    public function set_db($db_id)
    {

        $db_id = $db_id;
        $db = \Config\Database::connect();
        $db->setDatabase($db_id);

        return $db;

    }


}