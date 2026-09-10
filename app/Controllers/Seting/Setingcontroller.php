<?php

namespace App\Controllers\Seting;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;


class Setingcontroller extends BaseController
{

    use ResponseTrait;

    public function password_change()
    {

        $password_baru = $this->request->getPost("password_baru");
        $token = $this->request->getPost("token");

        try {

            $key = getenv('jwt.encryption.key');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            $gereja_id = $decoded->data->gereja_id;

            $db = \Config\Database::connect();
            $sql = "update tgereja set password='".$password_baru."' where gereja_id='".$gereja_id."'";

            $db->query($sql);

            return $this->respond([
                    'msg'  => "ok",
                    'pesan' => 'Password berhasil diubah'
            ]);


        } catch (\Exception $e) {
            
            return $this->respond([
                    'status'  => 401,
                    'pesan' => 'Token tidak valid'
            ]);
        }

    }

    public function simpan_nama_gereja()
    {

        $nama_gereja = $this->request->getPost("nama_gereja");
        $gereja_id = $this->request->getPost("gereja_id");
        
        $db = \Config\Database::connect();

        $sql = "update tgereja set nama_gereja='".$nama_gereja."' where gereja_id='".$gereja_id."'";

        $db->query($sql);
        
        return $this->respond([
            'msg'  => "ok",
            'pesan' => "update nama gereja"
        ]);

    }
    

    public function simpan_alamat_gereja()
    {

        $alamat_gereja = $this->request->getPost("alamat_gereja");
        $gereja_id = $this->request->getPost("gereja_id");
        
        $db = \Config\Database::connect();

        $sql = "update tgereja set alamat='".$alamat_gereja."' where gereja_id='".$gereja_id."'";

        $db->query($sql);
        
        return $this->respond([
            'msg'  => "ok",
            'pesan' => "update alamat gereja"
        ]);

    }


    public function simpan_kabkota_gereja()
    {

        $kabkota_id = $this->request->getPost("kabkota_id");
        $gereja_id = $this->request->getPost("gereja_id");
        
        $db = \Config\Database::connect();

        $sql = "update tgereja set kabupaten_id=".$kabkota_id." where gereja_id='".$gereja_id."'";

        $db->query($sql);
        
        return $this->respond([
            'msg'  => "ok",
            'pesan' => "update kabupaten gereja"
        ]);

    }


    public function simpan_koordinat_gereja()
    {

        $lat = $this->request->getPost("lat");
        $lng = $this->request->getPost("lng");
        $gereja_id = $this->request->getPost("gereja_id");
        
        $db = \Config\Database::connect();

        $sql = "update tgereja set lat=".$lat.", lng=".$lng." where gereja_id='".$gereja_id."'";

        $db->query($sql);
        
        return $this->respond([
            'msg'  => "ok",
            'pesan' => "update koordinat gereja"
        ]);

    }


    public function get_info_gereja() 
    {

        // print_r("test");

        $data = array();

        $token = $this->request->getPost("token");

        try {


            $key = getenv('jwt.encryption.key');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            $gereja_id = $decoded->data->gereja_id;

            $db = \Config\Database::connect();

            $sql = "select nama_gereja, alamat, lat, lng, kabupaten_id from tgereja where gereja_id='".$gereja_id."'";

            $query = $db->query($sql);

            $result = $query->getRow();

            $data['gereja_id'] = $gereja_id;
            $data['nama_gereja'] = $result->nama_gereja;
            $data['alamat'] = $result->alamat;
            $data['lat'] = $result->lat;
            $data['lng'] = $result->lng;
            $data['kabupaten_id'] = $result->kabupaten_id;

            $sql = "select provinsi_id from tkabupaten where kabupaten_id=".$result->kabupaten_id;

            $query = $db->query($sql);

            $result = $query->getRow();

            $data['provinsi_id'] = $result->provinsi_id;

            return $this->respond([
                    'msg'  => "ok",
                    'pesan' => $data
            ]);

            

        } catch (\Exception $e) {
            
            return $this->respond([
                    'status'  => 401,
                    'pesan' => $e->getMessage()
            ]);


        }


    }

}
