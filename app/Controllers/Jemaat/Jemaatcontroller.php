<?php

namespace App\Controllers\Jemaat;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
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
        // $tanggal_terdaftar = $this->request->getPost("tanggal_terdaftar");
        $tanggal_terdaftar = new Time('now');
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
                $meninggal = false;


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
                    if (is_null($res)) {
                        $meninggal = true;
                    } else {
                        $tanggal_wafat = $res?->tanggal_wafat;
                    }

                }

                array_push($data, 
                    array(
                        "anggotajemaat_id"=>$row->anggotajemaat_id,
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
                        "pekerjaan"=>$row->pekerjaan,
                        "meninggal"=>$meninggal
                    )
                );

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }



    }    


    public function jemaat_anggota_add()
    {

        $jemaat_id = $this->request->getPost("jemaat_id");

        $nama = $this->request->getPost("nama");
        $jk = $this->request->getPost("jk");
        $gol_darah = $this->request->getPost("golongan_darah");
        $tgl_lahir = $this->request->getPost("tgl_lahir");
        $tgl_baptis = $this->request->getPost("tgl_baptis");
        $tgl_sidi = $this->request->getPost("tgl_sidi");
        $tgl_menikah = $this->request->getPost("tgl_menikah");
        $posisi = $this->request->getPost("posisi");
        $pendidikan_terakhir = $this->request->getPost("pendidikan_terakhir");
        $pekerjaan = $this->request->getPost("pekerjaan");

        $sql = "insert into tanggotajemaat (nama, jk, golongan_darah, tanggal_lahir, tanggal_baptis, posisi, pendidikan_terakhir, pekerjaan, jemaat_id) values ";
        $sql = $sql . "('".$nama."','".$jk."','".$gol_darah."','".$tgl_lahir."','".$tgl_baptis."','".$posisi."','".$pendidikan_terakhir."','".$pekerjaan."',".$jemaat_id.")";

        $db = $this->set_db();

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


        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Anggota keluarga baru telah disimpan"
        ]);

    }

    public function jemaat_anggota_ubah_simpan()
    {

        $anggotajemaat_id = $this->request->getPost("anggotajemaat_id");

        $data = $this->request->getPost("data");

        $jk = $data['jk'];
        $gol_darah = $data['gol_darah'];
        $tgl_lahir = $data['tgl_lahir'];
        $tgl_baptis = $data['tgl_baptis'];
        $tgl_sidi = $data['tgl_sidi'];
        $tgl_menikah = $data['tgl_menikah'];
        $tgl_wafat = $data['tgl_wafat'];
        $posisi = $data['posisi'];
        $pendidikan_terakhir = $data['pendidikan_terakhir'];
        $pekerjaan = $data['pekerjaan'];
        $anggotajemaat_id = $data['anggotajemaat_id'];

        $db = $this->set_db();


        if ($jk) {

            $sql = "update tanggotajemaat set jk='".$jk."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }

        
        if ($gol_darah) {

            $sql = "update tanggotajemaat set golongan_darah='".$gol_darah."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }


        if ($tgl_lahir) {

            $sql = "update tanggotajemaat set tanggal_lahir='".$tgl_lahir."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }



        if ($tgl_baptis) {

            $sql = "update tanggotajemaat set tanggal_baptis='".$tgl_baptis."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }


        if ($tgl_sidi) {

            $sql = "select count(*) as jumlah from tsidi where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

            // update status sidi
            if ($query) {

                $row = $query->getRow();

                if ($row->jumlah==0) {

                    $sql = "insert into tsidi (anggotajemaat_id, tanggal_sidi) values (".$anggotajemaat_id.",'".$tgl_sidi."')";
                    $db->query($sql);

                }

                if ($row->jumlah==1) {

                    $sql = "update tsidi set tanggal_sidi='".$tgl_sidi."' where anggotajemaat_id=".$anggotajemaat_id;
                    $db->query($sql);

                }

            }

        }


        if ($tgl_menikah) {

            $sql = "select count(*) as jumlah from twafat where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

            // update status menikah
            if ($query) {

                $row = $query->getRow();

                if ($row->jumlah==0) {

                    $sql = "insert into tmenikah (anggotajemaat_id, tanggal_menikah) values (".$anggotajemaat_id.",'".$tgl_menikah."')";
                    $db->query($sql);

                }

                if ($row->jumlah==1) {

                    $sql = "update tmenikah set tangggal_menikah='".$tgl_menikah."' where anggotajemaat_id=".$anggotajemaat_id;
                    $db->query($sql);

                }

            }

        }


        if ($tgl_wafat) {

            $sql = "select count(*) as jumlah from twafat where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

            // update status meninggal
            if ($query) {

                $row = $query->getRow();
                if ($row->jumlah==0) {

                    $sql = "insert into twafat (anggotajemaat_id, tanggal_wafat) values (".$anggotajemaat_id.",'".$tgl_wafat."')";
                    $db->query($sql);

                }
            }

        }


        if ($posisi) {

            $sql = "update tanggotajemaat set posisi='".$posisi."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }

        if ($pendidikan_terakhir) {

            $sql = "update tanggotajemaat set pendidikan_terakhir='".$pendidikan_terakhir."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }

        if ($pekerjaan) {

            $sql = "update tanggotajemaat set pekerjaan='".$pekerjaan."' where anggotajemaat_id=".$anggotajemaat_id;

            $query = $db->query($sql);

        }

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Perubahan data keluarga jemaat telah disimpan."
        ]);

    }


    public function jemaat_anggota_del()
    {

        $anggotajemaat_id = $this->request->getPost("anggotajemaat_id");

        $db = $this->set_db();

        $sql = "delete from tanggotajemaat where anggotajemaat_id=".$anggotajemaat_id;

        $db->query($sql);

        return $this->respond([
            "msg"=>"ok", 
            "data"=>"Anggota keluarga telah dihapus"
        ]);


    }


    public function jemaat_anggota_all()
    {

        $db = $this->set_db();

        $sql = "select anggotajemaat_id, nama from tanggotajemaat";

        $query = $db->query($sql);

        if ($query) {

            $data = [];

            $result = $query->getResult();

            foreach($result as $row) {
                array_push($data, array("nama"=>$row->nama));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
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
