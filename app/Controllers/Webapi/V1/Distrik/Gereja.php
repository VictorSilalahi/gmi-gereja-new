<?php

namespace App\Controllers\Webapi\V1\Distrik;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;
use Exception;

use App\Controllers\BaseController;


class Gereja extends BaseController
{

    use ResponseTrait;
    

    public function gereja_all()
    {

        $distrik = $this->request->getPost("distrik");

        $sql = "select gereja_id, email, nama_gereja, alamat, lat, lng, kondisi_bangunan, kepemilikan from tgereja where distrik='".$distrik."'";

        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getResult();

            foreach($result as $row) {

                array_push($data, array(
                    "gereja_id"=>$row->gereja_id,
                    "email"=>$row->email,
                    "nama_gereja"=>$row->email,
                    "alamat"=>$row->alamat,
                    "kondisi_bangunan"=>$row->kondisi_bangunan,
                    "kepemilikan"=>$row->kepemilikan,
                    "lat"=>$row->lat,
                    "lng"=>$row->lng
                ));
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);


        } else {

            $error = $db->error();    
            log_message('error', 'Query failed: ' . $error['message']);
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);

        }

    }

    public function resort_edit()
    {

        $nama_resort = $this->request->getPost("nama_resort");

        $resort_id = $this->request->getPost("resort_id");

        $db = $this->activate_db();

        $sql = "update tresort set nama_resort='".$nama_resort."' where resort_id=".$resort_id;

        $query = $db->query($sql);
        
        if ($query) {

            return $this->respond([
                "msg"=>"ok", 
                "data"=>""
            ]);

        } else {

                $error = $db->error();    
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

        }


    }



   
    public function resort_add()
    {

        $nama_resort = $this->request->getPost("nama_resort");

        $distrik = $this->request->getPost("distrik");

        $db = $this->activate_db();

        $sql = "select distrik_id from tdistrik where distrik='".$distrik."'";

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getRow();

            $sql = "insert into tresort (nama_resort, distrik_id) values ('".$nama_resort."',".$result->distrik_id.")";

            $query = $db->query($sql);

            if ($query) {

                return $this->respond([
                    "msg"=>"ok", 
                    "data"=>""
                ]);

            } else {

                $error = $db->error();    
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

            }


        }




    }

    public function resort_del()
    {

        $resort_id = $this->request->getPost("resort_id");

        $sql = "delete from tresort where resort_id=".$resort_id;

        $db = $this->activate_db();

        $query = $db->query($sql);

        if ($query) {

            return $this->respond([
                "msg"=>"ok", 
                "data"=>""
            ]);

        } else {

            $error = $db->error();    

            log_message('error', 'Query failed: ' . $error['message']);

            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);

        }

    }

    public function resort_all()
    {

        $distrik = $this->request->getPost("distrik");

        $sql = "select distrik_id from tdistrik where distrik='".$distrik."'";

        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getRow();

            $sql = "select tresort.resort_id, tresort.nama_resort from tresort where tresort.distrik_id=".$result->distrik_id;

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach($result as $res) {

                    $sql = "select count(*) as jumlah_gereja from tanggotaresort where resort_id=".$res->resort_id;

                    $query3 = $db->query($sql);

                    $result3 = $query3->getRow();

                    array_push($data, array(
                        "resort_id"=>$res->resort_id,
                        "nama_resort"=>$res->nama_resort,
                        "jumlah_gereja"=>$result3->jumlah_gereja
                    ));
                }

                return $this->respond([
                    "msg"=>"ok", 
                    "data"=>$data
                ]);


            }

        } else {

            $error = $db->error();    

            log_message('error', 'Query failed: ' . $error['message']);

            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);
        
        }


    }

    public function resort_gereja()
    {

        $resort_id = $this->request->getPost("resort_id");

        $sql = "select tanggotaresort.anggotaresort_id, tgereja.gereja_id, tgereja.nama_gereja, tgereja.alamat from tgereja, tanggotaresort where tgereja.gereja_id=tanggotaresort.gereja_id and tanggotaresort.resort_id=".$resort_id;

        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getResult();

            foreach($result as $res) {

                array_push($data, array(
                    "anggotaresort_id"=>$res->anggotaresort_id,
                    "gereja_id"=>$res->gereja_id,
                    "nama_gereja"=>$res->nama_gereja,
                    "alamat"=>$res->alamat
                ));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);



        } else {

            $error = $db->error();    

            log_message('error', 'Query failed: ' . $error['message']);

            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$error['message']
            ]);


        }

    }


    public function gereja_detail()
    {

        $data = [];

        $jumlah_kk_aktif = 0;
        $jumlah_kk_tidak_aktif = 0;

        $jumlah_anggota_kk_aktif = 0;
        $jumlah_anggota_kk_tidak_aktif = 0;

        $anak_anak = 0;
        $remaja = 0;
        $pemuda = 0;
        $dewasa = 0;
        $lansia = 0;

        $penuh = 0;
        $persiapan = 0;

        $data_sektor = [];     
        
        $jumlah_pekerjaan_ASN = 0;
        $jumlah_pekerjaan_TNIPolri = 0;
        $jumlah_pekerjaan_KaryawanSwasta = 0;
        $jumlah_pekerjaan_Pedagang = 0;
        $jumlah_pekerjaan_Wiraswasta = 0;
        $jumlah_pekerjaan_Dokter = 0;
        $jumlah_pekerjaan_Petani = 0;
        $jumlah_pekerjaan_GuruInjil = 0;
        $jumlah_pekerjaan_Pendeta = 0;
        $jumlah_pekerjaan_BuruhHarianLepas = 0;
        $jumlah_pekerjaan_None = 0;

        $jumlah_pendidikan_None = 0;
        $jumlah_pendidikan_SD = 0;
        $jumlah_pendidikan_SMP = 0;
        $jumlah_pendidikan_SMASMK = 0;
        $jumlah_pendidikan_D3 = 0;
        $jumlah_pendidikan_S1 = 0;
        $jumlah_pendidikan_S2 = 0;
        $jumlah_pendidikan_S3 = 0;  

        $jumlah_janda = 0;
        $jumlah_duda = 0;


        $gereja_id = $this->request->getPost("gereja_id");

        $sql = "select db_id from tgereja where gereja_id='".$gereja_id."'";

        $db = $this->activate_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $db->setDatabase($result->db_id);


            // mencari anggota KK aktif/tidak aktif dan anggota KK aktif/tidak aktif
            // kk aktif
            $sql = "select count(*) as jumlah from tjemaat where status_keanggotaan='Aktif'";
            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();

                $jumlah_kk_aktif = $result->jumlah;


            } else {

                $error = $db->error(); 
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);


            }
            
            // kk tidak aktif
            $sql = "select count(*) as jumlah from tjemaat where status_keanggotaan='Tidak Aktif'";
            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();
                $jumlah_kk_tidak_aktif = $result->jumlah;

            } else {

                $error = $db->error(); 
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

            }


            // anggota kk aktif
            $sql = "select count(*) as jumlah from tjemaat, tanggotajemaat where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.status_keanggotaan='Aktif' and tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();
                $jumlah_anggota_kk_aktif = $result->jumlah;

            } else {

                $error = $db->error(); 
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

            }


            // anggota kk tidak aktif
            $sql = "select count(*) as jumlah from tjemaat, tanggotajemaat where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.status_keanggotaan='Tidak Aktif'";
            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();
                $jumlah_anggota_kk_tidak_aktif = $result->jumlah;

            } else {

                $error = $db->error(); 
                log_message('error', 'Query failed: ' . $error['message']);
                return $this->respond([
                    "msg"=>"error", 
                    "pesan"=>$error['message']
                ]);

            }


            // kelompok umur
            $sql = "select tanggal_lahir from tanggotajemaat where tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach ($result as $row) {

                    $tanggal_lahir = date_create($row->tanggal_lahir);
                    $tanggal_sekarang = Time::now();
                    $interval = date_diff($tanggal_lahir, $tanggal_sekarang);

                    // anak-anak
                    if ($interval->format('%y')<=12) {
                        $anak_anak = $anak_anak + 1;
                    } 

                    // remaja
                    if ($interval->format('%y')<=17 && $interval->format('%y')>=13) {
                        $remaja = $remaja + 1;
                    } 

                    // pemuda
                    if ($interval->format('%y')<=29 && $interval->format('%y')>=18) {
                        $pemuda = $pemuda + 1;
                    }             

                    // dewasa
                    if ($interval->format('%y')<=64 && $interval->format('%y')>=30) {
                        $dewasa = $dewasa + 1;
                    }  
                    
                    // lansia
                    if ($interval->format('%y')>=65) {
                        $lansia = $lansia + 1;
                    }  

                }

            }


        // sifat keanggotaan
            $sql = "select tanggotajemaat.anggotajemaat_id from tanggotajemaat where tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach ($result as $row) {

                    $sql = "select tsidi.is_sidi, tsidi.tanggal_sidi from tsidi where tsidi.anggotajemaat_id=".$row->anggotajemaat_id;

                    $query = $db->query($sql);

                    // echo($query->getNumRows());

                    if ($query->getNumRows()==1) {

                        $result2 = $query->getRow();

                        if ($result2->is_sidi==true) {
                            
                            $penuh = $penuh + 1;  
                        
                        } else {

                            if ($result2->tanggal_sidi!='0000-00-00') {

                                $penuh = $penuh + 1;

                            } else {

                                $persiapan = $persiapan + 1;

                            }

                        }


                    }

                }

            }


            // jemaat per sektor
            $sql = "select count(*) as jumlah, tsektor.nama_sektor from tanggotajemaat, tjemaat, tsektor where tanggotajemaat.jemaat_id=tjemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id and tanggotajemaat.anggotajemaat_id not in (select twafat.anggotajemaat_id from twafat)";

            $sql = "select tsektor.no_sektor, tsektor.nama_sektor from tsektor";

            $query = $db->query($sql);

            if ($query->getNumRows()>0) {

                $result = $query->getResult();

                foreach($result as $row) {

                    $sql = "select count(*) as jumlah from tanggotajemaat, tjemaat, tsektor where tanggotajemaat.jemaat_id=tjemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id and tsektor.no_sektor='".$row->no_sektor."' and tanggotajemaat.anggotajemaat_id not in (select twafat.anggotajemaat_id from twafat)";

                    $query2 = $db->query($sql);

                    if ($query2) {

                        $result2 = $query2->getRow();

                        array_push($data_sektor, array(
                            "sektor"=>$row->nama_sektor,
                            "jumlah"=>$result2->jumlah

                        ));


                    }

                }
            }

    
            // sebaran pekerjaan
            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='ASN' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_ASN = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='TNI-Polri' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_TNIPolri = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Karyawan-Swasta' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_KaryawanSwasta = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Pedagang' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Pedagang = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Wiraswasta' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Wiraswasta = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Dokter' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Dokter = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Petani' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Petani = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Petani' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Petani = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Guru-Injil' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_GuruInjil = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Pendeta' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_Pendeta = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='Buruh-Harian-Lepas' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_BuruhHarianLepas = $result->jumlah;
            }

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pekerjaan='None' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pekerjaan_None = $result->jumlah;
            }

            // sebaran pendidikan
            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='SD' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_SD = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='SMP' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_SMP = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='SMA-SMK' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_SMASMK = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='D3' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_D3 = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='S1' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_S1 = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='S2' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_S2 = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='S3' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_S3 = $result->jumlah;
            }        

            $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.pendidikan_terakhir='None' and anggotajemaat_id not in (select anggotajemaat_id from twafat)";
            $query = $db->query($sql);
            if ($query) {

                $result = $query->getRow();
                $jumlah_pendidikan_None = $result->jumlah;
            }        


            // janda duda
            $sql = "select anggotajemaat_id, jemaat_id, posisi from tanggotajemaat where tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getResult();

                foreach ($result as $row) {

                    if ($row->posisi=='Suami') {

                        $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.jemaat_id=".$row->jemaat_id." and tanggotajemaat.posisi='Istri' and tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";
                        
                        $query = $db->query($sql);

                        if ($query) {

                            $result2 = $query->getRow();
                            
                            if ($result2->jumlah==0) {

                                $jumlah_duda = $jumlah_duda + 1;

                            }

                        }

                    }

                    if ($row->posisi=='Istri') {

                        $sql = "select count(*) as jumlah from tanggotajemaat where tanggotajemaat.jemaat_id=".$row->jemaat_id." and tanggotajemaat.posisi='Suami' and tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";
                        
                        $query = $db->query($sql);

                        if ($query) {

                            $result2 = $query->getRow();
                            
                            if ($result2->jumlah==0) {

                                $jumlah_janda = $jumlah_janda + 1;

                            }

                        }

                    }

                }

            }                    


            array_push($data, 
                array(
                    "kk"=>array(
                        "jumlah kk jemaat aktif"=>$jumlah_kk_aktif, 
                        "jumlah kk jemaat tidak aktif"=>$jumlah_kk_tidak_aktif
                    ),
                    "anggota"=>array(
                        "jumlah anggota jemaat kk aktif"=>$jumlah_anggota_kk_aktif, 
                        "jumlah anggota jemaat kk tidak aktif"=>$jumlah_anggota_kk_tidak_aktif
                    ),
                    "kelompok umur"=>array(
                        "anak-anak"=>$anak_anak,
                        "remaja"=>$remaja,
                        "pemuda"=>$pemuda,
                        "dewasa"=>$dewasa,
                        "lansia"=>$lansia
                    ),
                    "sifat keanggotaan"=>array(
                        "penuh"=>$penuh,
                        "persiapan"=>$persiapan
                    ),
                    "data_sektor"=>$data_sektor,
                    "sebaran pekerjaan"=>array(
                        "ASN"=>$jumlah_pekerjaan_ASN,
                        "TNI-Polri"=>$jumlah_pekerjaan_TNIPolri,
                        "Karyawan Swasta"=>$jumlah_pekerjaan_KaryawanSwasta,
                        "Pedagang"=>$jumlah_pekerjaan_Pedagang,
                        "Wiraswasta"=>$jumlah_pekerjaan_Wiraswasta,
                        "Dokter"=>$jumlah_pekerjaan_Dokter,
                        "Petani"=>$jumlah_pekerjaan_Petani,
                        "Guru Injil"=>$jumlah_pekerjaan_GuruInjil,
                        "Pendeta"=>$jumlah_pekerjaan_Pendeta,
                        "Buruh Harian Lepas"=>$jumlah_pekerjaan_BuruhHarianLepas,
                        "None"=>$jumlah_pekerjaan_None
                    ),
                    "sebaran pendidikan"=>array(
                        "SD"=>$jumlah_pendidikan_SD,
                        "SMP"=>$jumlah_pendidikan_SMP,
                        "SMA-SMK"=>$jumlah_pendidikan_SMASMK,
                        "D3"=>$jumlah_pendidikan_D3,
                        "S1"=>$jumlah_pendidikan_S1,
                        "S2"=>$jumlah_pendidikan_S2,
                        "S3"=>$jumlah_pendidikan_S3,
                        "None"=>$jumlah_pendidikan_None
                    ),
                    "sebaran_janda_duda"=>array(
                        "janda"=>$jumlah_janda,
                        "duda"=>$jumlah_duda
                    )
                )
            );

            return $this->respond([
                    "msg"=>"ok", 
                    "data"=>$data
            ]);

        }



    }

    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }



}