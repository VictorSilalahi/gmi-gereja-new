<?php

namespace App\Controllers\Jemaat;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;

class Jemaatcontroller extends BaseController
{

    use ResponseTrait;


    public function jemaat_per_sektor()
    {

        $db = $this->set_db();

        $sektor_id = $this->request->getGet("sektor_id");

        $data = [];

        // ambil data jemaat di sektor yg dipilih
        $sql = "select jemaat_id, nik, alamat, mobile_phone, status_keanggotaan from tjemaat where tjemaat.sektor_id=".(int)$sektor_id;
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            foreach($result as $row) {


                $sql = "select anggotajemaat_id, nama, posisi from tanggotajemaat where tanggotajemaat.jemaat_id=".(int)$row->jemaat_id;
                $query = $db->query($sql);

                if ($query) {

                    $jumlah_anggota_keluarga = $query->getNumRows();

                    $result2 = $query->getResult();

                    $keluarga = [];
                    $pasangan = '';

                    foreach($result2 as $row2) {

                        if ($row2->posisi=='Suami') {
                            $pasangan = $row2->nama;
                        }
                    
                    }

                    foreach($result2 as $row2) {

                        if ($row2->posisi=='Istri') {
                                $pasangan = $pasangan."/".$row2->nama;
                        }
                    
                    }
                    
                    array_push($keluarga, array("pasangan"=>$pasangan, "jumlah"=>$jumlah_anggota_keluarga));

                }

                array_push($data, array("jemaat_id"=>$row->jemaat_id, "nik"=>$row->nik, "alamat"=>$row->alamat, "mobile_phone"=>$row->mobile_phone, "status_keanggotaan"=>$row->status_keanggotaan, "keluarga"=>$keluarga));


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


    public function jemaat_add()
    {

        $nik = $this->request->getPost("nik");
        $tanggal_terdaftar = $this->request->getPost("tanggal_terdaftar");
        $mobile_phone = $this->request->getPost("mobile_phone");
        $alamat = $this->request->getPost("alamat");
        $status_keanggotaan = $this->request->getPost("status_keanggotaan");
        $sektor_id = $this->request->getPost("sektor_id");
        $daftar = $this->request->getPost("daftar");

        $db = $this->set_db();

        // check nik terlebih dahulu
        $sql = "select count(*) as jumlah from tjemaat where nik='".$nik."'";
        $query = $db->query($sql);

        $result = $query->getRow(); 

        if (isset($result)) {

                if ($result->jumlah>0) {

                    return $this->respond([
                        "msg"=>"error", 
                        "data"=>"Data nik sudah terpakai!"
                    ]);
                }
        }
        

        $sql = "insert into tjemaat (nik, status_keanggotaan, sektor_id, alamat, mobile_phone, tanggal_terdaftar) values ";
        $sql = $sql ."('".$nik."','".$status_keanggotaan."',".$sektor_id.",'".$alamat."','".$mobile_phone."','".$tanggal_terdaftar."')";

        $db->query($sql);
        
        $jemaat_id = $db->insertID();

        foreach ($daftar as $d) {
            $nama = $d['nama'];
            $jk = $d['jk'];
            $gol_darah = $d['gol_darah'];
            $tgl_lahir = $d['tgl_lahir'];
            $tgl_baptis = $d['tgl_baptis'];
            $tgl_sidi = $d['tgl_sidi'];
            $tgl_menikah = $d['tgl_menikah'];
            $posisi = $d['posisi'];
            $pendidikan_terakhir = $d['pendidikan_terakhir'];
            $pekerjaan = $d['pekerjaan'];

            $sql = "insert into tanggotajemaat (jemaat_id, nama, jk, golongan_darah, tanggal_lahir, tanggal_baptis, posisi, pendidikan_terakhir, pekerjaan) values ";
            $sql = $sql . "(".$jemaat_id.",'".$nama."','".$jk."','".$gol_darah."','".$tgl_lahir."','".$tgl_baptis."','".$posisi."','".$pendidikan_terakhir."','".$pekerjaan."')";

            $db->query($sql);

            $anggotajemaat_id = $db->insertID();

            if ($tgl_sidi) {
                $sql = "insert into tsidi (anggotajemaat_id, tanggal_sidi) values (".$anggotajemaat_id.",'".$tgl_sidi."')";
                $db->query($sql);
            }

            if ($tgl_menikah) {
                $sql = "insert into tmenikah (anggotajemaat_id, tanggal_menikah) values (".$anggotajemaat_id.",'".$tgl_menikah."')";
                $db->query($sql);
            }


        }

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Data jemaat baru telah disimpan!"
        ]);
        
        
    }

    public function jemaat_nik()
    {

        $jemaat_id = $this->request->getGet("jemaat_id");

        $db = $this->set_db();

        $sql = "select * from tjemaat where jemaat_id=".$jemaat_id;

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getRow();

            $data = array(
                        "jemaat_id"=>$result->jemaat_id,
                        "nik"=>$result->nik,
                        "alamat"=>$result->alamat,
                        "status_keanggotaan"=>$result->status_keanggotaan
            );

            // array_push($data, 
            //     array(
            //         "jemaat_id"=>$result->jemaat_id,
            //         "nik"=>$result->nik,
            //         "alamat"=>$result->alamat,
            //         "status_keanggotaan"=>$result->status_keanggotaan
            //     )
            // );

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }


    }

    public function jemaat_anggota()
    {

        $jemaat_id = $this->request->getGet("jemaat_id");

        $db = $this->set_db();

        $sql = "select * from tanggotajemaat where jemaat_id=".$jemaat_id;

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getResult();

            $data = [];
            foreach ($result as $row) {

                $tanggal_sidi = null;
                $tanggal_menikah = null;
                $tanggal_wafat = null;

                $sql = "select tsidi.tanggal_sidi from tsidi where tsidi.anggotajemaat_id=".$row->anggotajemaat_id;
                $query = $db->query($sql);
                if ($query) {
                    $res = $query->getRow();
                    $tanggal_sidi = $res?->tanggal_sidi;

                }
                
                $sql = "select tmenikah.tanggal_menikah from tmenikah where tmenikah.anggotajemaat_id=".$row->anggotajemaat_id;
                $query = $db->query($sql);
                if ($query) {
                    $res = $query->getRow();
                    $tanggal_menikah = $res?->tanggal_menikah;

                }

                $sql = "select twafat.tanggal_wafat from twafat where twafat.anggotajemaat_id=".$row->anggotajemaat_id;
                $query = $db->query($sql);
                if ($query) {
                    $res = $query->getRow();
                    $tanggal_wafat = $res?->tanggal_wafat;

                }

                array_push($data, 
                    array(
                        "nama"=>$row->nama,
                        "jk"=>$row->jk,
                        "golongan_darah"=>$row->golongan_darah,
                        "tgl_lahir"=>$row->tanggal_lahir,
                        "tgl_baptis"=>$row->tanggal_baptis,
                        "tgl_sidi"=>$tanggal_sidi,
                        "tgl_menikah"=>$tanggal_menikah,
                        "tgl_wafat"=>$tanggal_wafat,
                        "posisi"=>$row->posisi,
                        "pendidikan_terakhir"=>$row->pendidikan_terakhir,
                        "pekerjaan"=>$row->pekerjaan
                    )
                );

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }



    }    


    public function jemaat_change()
    {

    
    }

    public function jemaat_del()
    {

        $db = $this->set_db();



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
