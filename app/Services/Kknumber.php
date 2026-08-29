<?php

namespace App\Services;

class Kknumber
{
    protected $db;

    public function __construct()
    {
        

    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function new_number($sektor_id)
    {

        $sql = "select nik from tjemaat where jemaat_id = (select max(jemaat_id) from tjemaat where sektor_id=".$sektor_id.")";
        $query = $this->db->query($sql);

        if ($query->getNumRows()>0) {

            $temp = $query->getRow();

            $temp2 = explode("-", $temp->nik);

            // print_r($temp2);

            $numb = (int)$temp2[1];

            // echo($numb);

            $new_numb = '';

            if ($numb+1<10) {
                $new_numb = "00".strval($numb+1); 
            }

            if ($numb+1>9 && $numb+1<100) {
                $new_numb = "0".strval($numb+1); 
            }

            return $new_numb;

        } else {

            $new_numb = "001";

            return $new_numb;

        }
        

    }


}