<?php

namespace App\Controllers\Report;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;

class Reportcontroller extends BaseController
{

    use ResponseTrait;

    public function jemaat_sektor()
    {

        $sektor_id = $this->request->getGet("sektor_id");

        $db = $this->set_db();

        $sql = "select jemaat_id, nik, status_keanggotaan, alamat, mobile_phone from tjemaat where sektor_id=".$sektor_id;
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();
            $data = [];

            foreach($result as $row) {

                $sql = "select nama, jk, golongan_darah, tanggal_lahir, tanggal_baptis, posisi, pendidikan_terakhir, pekerjaan from tanggotajemaat where jemaat_id=".$row->jemaat_id;
                $query2 = $db->query($sql);

                if ($query2) {

                    $result2 = $query2->getResult();
                    $keluarga = [];

                    foreach($result2 as $row2) {

                        array_push($keluarga,
                            array(
                                "nama"=>$row2->nama,
                                "jk"=>$row2->jk,
                                "golongan_darah"=>$row2->golongan_darah,
                                "tanggal_lahir"=>$row2->tanggal_lahir,
                                "tanggal_baptis"=>$row2->tanggal_baptis,
                                "posisi"=>$row2->posisi,
                                "pendidikan_terakhir"=>$row2->pendidikan_terakhir,
                                "pekerjaan"=>$row2->pekerjaan
                            )
                        );
                    }

                    $jumlah_keluarga = count($keluarga);

                }

                array_push($data,
                    array(
                        "nik"=>$row->nik, 
                        "alamat"=>$row->alamat, 
                        "status_keanggotaan"=>$row->status_keanggotaan, 
                        "jumlah"=>$jumlah_keluarga,
                        "keluarga"=>$keluarga
                    )
                );

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);
        
        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>""
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

}