<?php

namespace App\Controllers\Kebaktian;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

use App\Controllers\BaseController;

class Kebaktiancontroller extends BaseController
{

    use ResponseTrait;


    public function kebaktian_bulan_ini()
    {

        $m = date("m");
        $y = date("Y");

        // ambil data kebaktian bulan-tahun ini
        $sql = "select kebaktian_id, tanggal from tkebaktian where MONTH(tanggal)=".$m." and YEAR(tanggal)=".$y." order by tanggal desc";

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query->getNumRows()>0) {

            $result = $query->getResult();
            
            $data = [];

            foreach($result as $row) {

                $sql = "select datakebaktian_id, no_ibadah, kehadiran, persembahan from tdatakebaktian where kebaktian_id=".$row->kebaktian_id;
                
                $query = $db->query($sql);

                if ($query->getNumRows()>0) {

                    $result2 = $query->getResult();

                    $kebaktian = [];
                    foreach($result2 as $row2) {
                        array_push($kebaktian, array(
                            "datakebaktian_id"=>$row2->datakebaktian_id,
                            "no_ibadah"=>$row2->no_ibadah,
                            "kehadiran"=>$row2->kehadiran,
                            "persembahan"=>$row2->persembahan 
                        ));
                    }

                    array_push($data, array(
                        "kebaktian_id"=>$row->kebaktian_id, 
                        "tanggal"=>$row->tanggal,
                        "data"=>$kebaktian
                    ));

                } else {

                    array_push($data, array(
                        "kebaktian_id"=>$row->kebaktian_id, 
                        "tanggal"=>$row->tanggal,
                        "data"=>null
                    ));

                }


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
