<?php

namespace App\Controllers\Report;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;
use DateTime;
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

                $sql = "select anggotajemaat_id, nama, jk, golongan_darah, tanggal_lahir, tanggal_baptis, posisi, pendidikan_terakhir, pekerjaan from tanggotajemaat where jemaat_id=".$row->jemaat_id;
                $query2 = $db->query($sql);

                if ($query2) {

                    $result2 = $query2->getResult();
                    $keluarga = [];

                    foreach($result2 as $row2) {

                        $tgl_sidi = '';
                        $tgl_menikah = '';

                        // periksa apakah ada tgl sidi
                        $sql = "select tanggal_sidi from tsidi where anggotajemaat_id=".$row2->anggotajemaat_id;
                        $query3 = $db->query($sql);

                        if ($query3) {

                            $result3 = $query3->getRow();

                            if ($result3->tanggal_sidi) {
                                $tgl_sidi = $result3->tanggal_sidi;
                            }

                        }

                        // periksa apakah ada tgl menikah
                        $sql = "select tanggal_menikah from tmenikah where anggotajemaat_id=".$row2->anggotajemaat_id;
                        $query3 = $db->query($sql);

                        if ($query3) {

                            $result3 = $query3->getRow();

                            if ($result3->tanggal_menikah) {
                                $tgl_menikah = $result3->tanggal_menikah;
                            }

                        }

                        array_push($keluarga,
                            array(
                                "nama"=>$row2->nama,
                                "jk"=>$row2->jk,
                                "golongan_darah"=>$row2->golongan_darah,
                                "tgl_lahir"=>$row2->tanggal_lahir,
                                "tgl_baptis"=>$row2->tanggal_baptis,
                                "tgl_sidi"=>$tgl_sidi,
                                "tgl_menikah"=>$tgl_menikah,
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
                "pesan"=>$e->getMessage()
            ]);

        }

    }

    public function pejabat_all()
    {

        

    }

    public function kelompok_umur()
    {

        $kelompok_umur = $this->request->getPost("kelompok_umur");

        $sql = "select tsektor.nama_sektor, tjemaat.nik, tanggotajemaat.nama, tjemaat.alamat, tanggotajemaat.tanggal_lahir, tjemaat.status_keanggotaan from tjemaat, tanggotajemaat, tsektor where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id and tanggotajemaat.anggotajemaat_id not in (select twafat.anggotajemaat_id from twafat)";
        
        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            $data = [];
            $anak_anak = [];
            $remaja = [];
            $pemuda = [];
            $dewasa = [];
            $lansia = [];

            foreach ($result as $row) {

                $tanggal_lahir = date_create($row->tanggal_lahir);
                $tanggal_sekarang = Time::now();

                $interval = date_diff($tanggal_lahir, $tanggal_sekarang);

                // echo($interval->format('%y')."<br>");

                // anak-anak
                if ($interval->format('%y')<=12) {
                    array_push($anak_anak, 
                        array(
                            "nik"=>$row->nik,
                            "nama"=>$row->nama,
                            "alamat"=>$row->alamat,
                            "sektor"=>$row->nama_sektor,
                            "status_keanggotaan"=>$row->status_keanggotaan
                        )
                    );
                } 

                // remaja
                if ($interval->format('%y')<=17 && $interval->format('%y')>=13) {
                    array_push($remaja, 
                        array(
                            "nik"=>$row->nik,
                            "nama"=>$row->nama,
                            "alamat"=>$row->alamat,
                            "sektor"=>$row->nama_sektor,
                            "status_keanggotaan"=>$row->status_keanggotaan
                        )
                    );
                } 

                // pemuda
                if ($interval->format('%y')<=29 && $interval->format('%y')>=18) {
                    array_push($pemuda, 
                        array(
                            "nik"=>$row->nik,
                            "nama"=>$row->nama,
                            "alamat"=>$row->alamat,
                            "sektor"=>$row->nama_sektor,
                            "status_keanggotaan"=>$row->status_keanggotaan
                        )
                    );
                }             

                // dewasa
                if ($interval->format('%y')<=64 && $interval->format('%y')>=30) {
                    array_push($dewasa, 
                        array(
                            "nik"=>$row->nik,
                            "nama"=>$row->nama,
                            "alamat"=>$row->alamat,
                            "sektor"=>$row->nama_sektor,
                            "status_keanggotaan"=>$row->status_keanggotaan
                        )
                    );
                }  
                
                // lansia
                if ($interval->format('%y')>=65) {
                    array_push($lansia, 
                        array(
                            "nik"=>$row->nik,
                            "nama"=>$row->nama,
                            "alamat"=>$row->alamat,
                            "sektor"=>$row->nama_sektor,
                            "status_keanggotaan"=>$row->status_keanggotaan
                        )
                    );
                }  
                
            }

            $data = array("anak-anak"=>$anak_anak, "remaja"=>$remaja, "pemuda"=>$pemuda, "dewasa"=>$dewasa, "lansia"=>$lansia);

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);


        }

    }


    public function ulang_tahun()
    {
        helper('html');

        $tgl_awal = date_create($this->request->getPost("tgl_awal"));
        $tgl_akhir = date_create($this->request->getPost("tgl_akhir"));


        $sql = "select tsektor.nama_sektor, tjemaat.nik, tanggotajemaat.nama, tjemaat.alamat, tanggotajemaat.tanggal_lahir from tjemaat, tanggotajemaat, tsektor where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id";
        
        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            $data = [];

            foreach ($result as $row) {
                
                $tanggal_lahir = date_create($row->tanggal_lahir);

                $temp = $this->isDayMonthBetween($row->tanggal_lahir, $this->request->getPost("tgl_awal"), $this->request->getPost("tgl_akhir"));

                if ($temp==true) {
                    array_push($data, 
                            array(
                                "nik"=>$row->nik,
                                "nama"=>$row->nama,
                                "tanggal_lahir"=>$row->tanggal_lahir,
                                "alamat"=>$row->alamat,
                                "sektor"=>$row->nama_sektor
                            )
                    );

                }
                
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);
        
        }
    

    }


    public function pernikahan()
    {
        helper('html');

        $tgl_awal = $this->request->getPost("tgl_awal");
        $tgl_akhir = $this->request->getPost("tgl_akhir");


        $sql = "select tsektor.nama_sektor, tjemaat.nik, tanggotajemaat.nama, tjemaat.alamat, tmenikah.tanggal_menikah from tjemaat, tanggotajemaat, tsektor, tmenikah where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id and tanggotajemaat.anggotajemaat_id=tmenikah.anggotajemaat_id";
        
        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            $data = [];

            foreach ($result as $row) {
                
                $tanggal_menikah = $row->tanggal_menikah;

                $temp = $this->isDayMonthBetween($tanggal_menikah, $tgl_awal, $tgl_akhir);

                if ($temp==true) {
                    array_push($data, 
                            array(
                                "nik"=>$row->nik,
                                "nama"=>$row->nama,
                                "tanggal_menikah"=>$row->tanggal_menikah,
                                "alamat"=>$row->alamat,
                                "sektor"=>$row->nama_sektor
                            )
                    );

                }
                
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);

        }
    

    }


    public function get_data_statistik()
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

        $db = $this->set_db();

        // mencari anggota KK aktif/tidak aktif dan anggota KK aktif/tidak aktif
        // kk aktif
        $sql = "select count(*) as jumlah from tjemaat where status_keanggotaan='Aktif'";
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $jumlah_kk_aktif = $result->jumlah;


        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);

        }


        // kk tidak aktif
        $sql = "select count(*) as jumlah from tjemaat where status_keanggotaan='Tidak Aktif'";
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $jumlah_kk_tidak_aktif = $result->jumlah;


        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);

        }


        // anggota kk aktif
        $sql = "select count(*) as jumlah from tjemaat, tanggotajemaat where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.status_keanggotaan='Aktif' and tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $jumlah_anggota_kk_aktif = $result->jumlah;


        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
            ]);

        }


        // anggota kk tidak aktif
        $sql = "select count(*) as jumlah from tjemaat, tanggotajemaat where tjemaat.jemaat_id=tanggotajemaat.jemaat_id and tjemaat.status_keanggotaan='Tidak Aktif'";
        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $jumlah_anggota_kk_tidak_aktif = $result->jumlah;


        } else {

            log_message('error', $e->getMessage());
            return $this->respond([
                "msg"=>"error", 
                "pesan"=>$e->getMessage()
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

                // echo($interval->format('%y')."<br>");

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
        $sql = "select tanggal_lahir, tanggal_baptis from tanggotajemaat where tanggotajemaat.anggotajemaat_id not in (select anggotajemaat_id from twafat)";

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getResult();

            foreach ($result as $row) {

                if (is_null($row->tanggal_baptis) || $row->tanggal_baptis==='0000-00-00') {
                    $persiapan = $persiapan + 1;
                } else {
                    $penuh = $penuh + 1;
                }

            }

        }


        // jemaat per sektor
        $sql = "select count(*) as jumlah, tsektor.no_sektor, tsektor.nama_sektor from tanggotajemaat, tjemaat, tsektor where tanggotajemaat.jemaat_id=tjemaat.jemaat_id and tjemaat.sektor_id=tsektor.sektor_id group by tsektor.nama_sektor and tanggotajemaat.anggotajemaat_id not in (select twafat.anggotajemaat_id from twafat)";

        $query = $db->query($sql);

 
        if ($query) {

            $result = $query->getResult();

            foreach($result as $row) {
                array_push($data_sektor, array(
                    "sektor"=>$row->nama_sektor,
                    "jumlah"=>$row->jumlah

                ));
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
                "data_sektor"=>$data_sektor
            )
        );

        return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
        ]);
    }

    function isDayMonthBetween($checkDate, $startDate, $endDate) {
        // 1. Convert all inputs to DateTime objects
        $check = date_create($checkDate);
        $start = date_create($startDate);
        $end   = date_create($endDate);

        // 2. Extract only the month and day components
        $checkMonthDay = $check->format('m-d');
        $startMonthDay = $start->format('m-d');
        $endMonthDay   = $end->format('m-d');

        // 3. Handle standard chronological ranges (e.g., May 1st to July 15th)
        if ($startMonthDay <= $endMonthDay) {
            return ($checkMonthDay >= $startMonthDay && $checkMonthDay <= $endMonthDay);
        }

        // 4. Handle ranges spanning across the New Year (e.g., Dec 25th to Jan 5th)
        return ($checkMonthDay >= $startMonthDay || $checkMonthDay <= $endMonthDay);
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