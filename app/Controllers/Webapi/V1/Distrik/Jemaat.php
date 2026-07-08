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
    

    public function jemaat_all($distrik)
    {
        
        $distrik = $distrik;

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"jemaat API! ".$distrik
        ]);

    }


}