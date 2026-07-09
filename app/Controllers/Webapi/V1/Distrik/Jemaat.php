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
    
    public function jemaat_all()
    {
        
        $distrik = $this->request->getPost("distrik");

        $sql = "select db_id from tgereja where distrik='".$distrik."'";
        $db = $this->activate_db();

        $query = $db->query($sql);

        $data = [];

        if ($query) {

            $result = $query->getResult();

            $jumlah_kk = 0;
            $jumlah_jiwa = 0;

            foreach($result as $row) {

                // pindah database menjadi database gereja di dalam distrik
                $db = $this->set_db($row->db_id);
    
                // cari jumlah KK
                $sql = "select count(*) as jumlah from tjemaat";
                $result = $db->query($sql);
                $row = $result->getRow();

                $jumlah_kk = $jumlah_kk + $row->jumlah;
                
                // cari jumlah jiwa
                $sql = "select count(*) as jumlah from tanggotajemaat where anggotajemaat_id not in (select anggotajemaat_id from twafat)";
                $result = $db->query($sql);
                $row = $result->getRow();

                $jumlah_jiwa = $jumlah_jiwa + $row->jumlah;

                $golongan_darah = [];

                $sql = "select golongan_darah, pendidikan_terakhir, pekerjaan, tanggal_lahir, tanggal_baptis from tanggotajemaat where anggotajemaat_id not in (select anggotajemaat_id from twafat)";

                $query = $db->query($sql);

                if ($query) {

                    $result = $query->getResult();

                    $gol_A = 0;
                    $gol_B = 0;
                    $gol_AB = 0;
                    $gol_O = 0;

                    $SD = 0;
                    $SMP = 0;
                    $SMA_SMK = 0;
                    $D3 = 0;
                    $S1 = 0;
                    $S2 = 0;
                    $S3 = 0;
                    $P_None = 0;

                    $ASN = 0;
                    $TNI_Polri = 0;
                    $Karyawan_Swasta = 0;
                    $Pedagang = 0;
                    $Wiraswasta = 0;
                    $Dokter = 0;
                    $Petani = 0;
                    $Pek_None = 0;



                    foreach($result as $row) {

                        // golongan darah
                        if ($row->golongan_darah == 'A') {
                            $gol_A = $gol_A + 1;
                        }

                        if ($row->golongan_darah == 'B') {
                            $gol_B = $gol_B + 1;
                        }

                        if ($row->golongan_darah == 'AB') {
                            $gol_AB = $gol_AB + 1;
                        }

                        if ($row->golongan_darah == 'O') {
                            $gol_O = $gol_O + 1;
                        }


                        // pendidikan terakhir
                        if ($row->pendidikan_terakhir == 'SD') {
                            $SD = $SD + 1;
                        }

                        if ($row->pendidikan_terakhir == 'SMP') {
                            $SMP = $SMP + 1;
                        }

                        if ($row->pendidikan_terakhir == 'SMA=SMK') {
                            $SMA_SMK = $SMA_SMK + 1;
                        }

                        if ($row->pendidikan_terakhir == 'D3') {
                            $D3 = $D3 + 1;
                        }

                        if ($row->pendidikan_terakhir == 'S1') {
                            $S1 = $S1 + 1;
                        }

                        if ($row->pendidikan_terakhir == 'S2') {
                            $S2 = $S2 + 1;
                        }

                        if ($row->pendidikan_terakhir == 'S3') {
                            $S3 = $S3 + 1;
                        }

                        if ($row->pendidikan_terakhir == 'None') {
                            $P_None = $P_None + 1;
                        }


                        // pekerjaan
                        if ($row->pekerjaan == 'ASN') {
                            $ASN = $ASN + 1;
                        }

                        if ($row->pekerjaan == 'TNI-Polri') {
                            $TNI_Polri = $TNI_Polri + 1;
                        }

                        if ($row->pekerjaan == 'Karyawan-Swasta') {
                            $Karyawan_Swasta = $Karyawan_Swasta + 1;
                        }

                        if ($row->pekerjaan == 'Pedagang') {
                            $Pedagang = $Pedagang + 1;
                        }

                        if ($row->pekerjaan == 'Wiraswasta') {
                            $Wiraswasta = $Wiraswasta + 1;
                        }
                    
                        if ($row->pekerjaan == 'Dokter') {
                            $Dokter = $Dokter + 1;
                        }

                        if ($row->pekerjaan == 'Petani') {
                            $Petani = $Petani + 1;
                        }

                        if ($row->pekerjaan == 'None') {
                            $Pek_None = $Pek_None + 1;
                        }   


                        // kelompok umur



                        // tipe keaonggotaan (persiapan/penuh)
                        
                    }



                }

                $data['jumlah_kk'] = $jumlah_kk;
                $data['jumlah_jiwa'] = $jumlah_jiwa;

                $data['gol_darah']['A'] = $gol_A;
                $data['gol_darah']['B'] = $gol_B;
                $data['gol_darah']['AB'] = $gol_AB;
                $data['gol_darah']['O'] = $gol_O;

                $data['pendidikan']['SD'] = $SD;
                $data['pendidikan']['SMP'] = $SMP;
                $data['pendidikan']['SMA_SMK'] = $SMA_SMK;
                $data['pendidikan']['D3'] = $D3;
                $data['pendidikan']['S1'] = $S1;
                $data['pendidikan']['S2'] = $S2;
                $data['pendidikan']['S3'] = $S3;
                $data['pendidikan']['None'] = $P_None;

                $data['pekerjaan']['ASN'] = $ASN;
                $data['pekerjaan']['TNI-Polri'] = $TNI_Polri;
                $data['pekerjaan']['Karyawan-Swasta'] = $Karyawan_Swasta;
                $data['pekerjaan']['Pedagang'] = $Pedagang;
                $data['pekerjaan']['Wiraswasta'] = $Wiraswasta;
                $data['pekerjaan']['Dokter'] = $Dokter;
                $data['pekerjaan']['Petani'] = $Petani;
                $data['pekerjaan']['None'] = $Pek_None;


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



    public function activate_db()
    {

        $db = \Config\Database::connect();

        return $db;

    }

    public function set_db($db_id)
    {

        $db_id = $db_id;
        $db = \Config\Database::connect();
        $db->setDatabase($db_id);

        return $db;

    }


}