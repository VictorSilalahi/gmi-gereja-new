<?php 

namespace App\Libraries;

class Servicedb
{
    protected $db_gereja;

    public function setDbGereja($val)
    {
        $this->db_gereja = $val;
    }

    public function getDbGereja()
    {
        return $this->db_gereja;
    }
    
}