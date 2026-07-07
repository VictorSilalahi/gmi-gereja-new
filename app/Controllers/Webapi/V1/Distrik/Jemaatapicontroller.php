<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;


class Jemaatapicontroller extends BaseController
{

    use ResponseTrait;
    

    public function jemaat_all()
    {


        return $this->respond([
            "msg"=>"ok", 
            "data"=>"jemaat API!"
        ]);

    }


}