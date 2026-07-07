<?php

namespace App\Services;

use CodeIgniter\I18n\Time;

class Catatlog
{
    protected $db;

    public function __construct()
    {
 
    }

    public function setDb($db)
    {
        $this->db = $db;
    }


    public function catat($operasi, $tujuan)
    {

        $sekarang = Time::now();

        $this->db->query("insert into thistoryapp (operasi, tujuan, tanggal_operasi) values ('".$operasi."','".$tujuan."','".$sekarang."')");

    }


}