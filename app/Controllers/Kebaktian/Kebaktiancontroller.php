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

        $sundays = [];
        
        // Get the first and last day of the current month
        $start = new \DateTime('first day of this month');
        $end = new \DateTime('last day of this month 23:59:59');
        
        // Find the first Sunday of the month to start our period loop
        $firstSunday = new \DateTime('first sunday of this month');
        
        // Interval of 1 week
        $interval = new \DateInterval('P1W');
        
        // Generate the date period between the first Sunday and the end of the month
        $period = new \DatePeriod($firstSunday, $interval, $end);
        
        foreach ($period as $date) {
            $sundays[] = $date->format('Y-m-d');
        }
        
        // print_r($sundays);
        
        $data = [];

        $db = $this->set_db();

        foreach($sundays as $sunday) {

            // ambil data kebaktian bulan-tahun ini
            $sql = "select kebaktian_id, tanggal from tkebaktian where tanggal='".$sunday."'";

            $query = $db->query($sql);

            if ($query->getNumRows()>0) {

                $result = $query->getRow();
                
                $sql = "select datakebaktian_id, no_ibadah, kehadiran, persembahan from tdatakebaktian where kebaktian_id=".$result->kebaktian_id;
                   
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
                            "tanggal"=>$sunday,
                            "data"=>$kebaktian
                        ));


                }


            } else {

                array_push($data, array(
                    "tanggal"=>$sunday,
                    "data"=>null
                ));

            }       


        }      

        $dibalik = array_reverse($data);
        return $this->respond([
            "msg"=>"ok", 
            "data"=>$dibalik
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
