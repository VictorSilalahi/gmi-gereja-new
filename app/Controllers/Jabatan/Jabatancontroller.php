<?php

namespace App\Controllers\Jabatan;

use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

use App\Controllers\BaseController;

class Jabatancontroller extends BaseController
{

    use ResponseTrait;
    

    public function jabatan_all()
    {

        $sql = "select jabatan_id, jabatan from tjabatan";

        $db = $this->set_db();

        $query = $db->query($sql);
        
        if ($query) {

            $results = $query->getResult();

            $data = [];

            foreach($results as $row) {

                array_push($data, array("jabatan_id"=>$row->jabatan_id, "jabatan"=>$row->jabatan));

            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }

    }

    public function jabatan_add()
    {

        $jabatan = $this->request->getPost("jabatan");

        $sql = "insert into tjabatan (jabatan) values ('".$jabatan."')";

        $db = $this->set_db();

        $query = $db->query($sql);
    
        return $this->respond([
                "msg"=>"ok", 
                "data"=>"data jabatan berhasil ditambahkan"
        ]);
    }


    public function jabatan_change()
    {
        $jabatan_id = $this->request->getPost("jabatan_id");
        $jabatan = $this->request->getPost("jabatan");

        $db = $this->set_db();

        $sql = "update tjabatan set jabatan='".$jabatan."' where jabatan_id=".$jabatan_id;

        $db->query($sql);

        return $this->respond([
                "msg"=>"ok", 
                "data"=>"data jabatan berhasil diubah"
        ]);


    }


    public function jabatan_del()
    {

        $jabatan_id = $this->request->getPost("jabatan_id");    

        // periksa apakah jabatan ini sudah dipakai
        $sql = "select count(*) as jumlah from tpejabat where jabatan_id=".$jabatan_id;

        $db = $this->set_db();

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            if ($result->jumlah==0) {


                $sql = "delete from tjabatan where jabatan_id=".$jabatan_id;

                $db->query($sql);

                return $this->respond([
                        "msg"=>"ok", 
                        "data"=>"data jabatan berhasil dihapus"
                ]);


            } else {

                return $this->respond([
                        "msg"=>"error", 
                        "data"=>"data jabatan tidak bisa dihapus"
                ]);

            }


        }


    }


    public function pejabat_all()
    {

        $db = $this->set_db();

        $sql = "select tpejabat.pejabat_id, tanggotajemaat.nama, tjabatan.jabatan from tanggotajemaat, tjabatan, tpejabat where tanggotajemaat.anggotajemaat_id=tpejabat.anggotajemaat_id and tpejabat.jabatan_id=tjabatan.jabatan_id";

        $query = $db->query($sql);

        if ($query) {
            
            $result = $query->getResult();

            $data = [];

            foreach($result as $row) {

                array_push(
                    $data, array(
                        "pejabat_id"=>$row->pejabat_id,
                        "nama"=>$row->nama,
                        "jabatan"=>$row->jabatan
                    )
                );
            }

            return $this->respond([
                "msg"=>"ok", 
                "data"=>$data
            ]);

        }

    }


    public function pejabat_add()
    {

        $nama = $this->request->getPost("nama");
        $jabatan_id = $this->request->getPost("jabatan_id");
        $tanggal_pengangkatan = $this->request->getPost("tanggal_pengangkatan");
        // echo($tanggal_pengangkatan);

        $db = $this->set_db();

        $sql = "select anggotajemaat_id from tanggotajemaat where nama='".$nama."'";

        $query = $db->query($sql);
        
        if ($query) {

            $result = $query->getRow();

            $sql = "insert into tpejabat (anggotajemaat_id, jabatan_id) values (".$result->anggotajemaat_id.",".$jabatan_id.")";

            $db->query($sql);

            $sql = "select jabatan from tjabatan where jabatan_id=".$jabatan_id;

            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();

                $jabatan = $result->jabatan;

                // masukkan ke history jabatan
                $sql = "insert into thistorypejabat (nama, jabatan_id, tanggal_pengangkatan) values ('".$nama."','".$jabatan_id."','".$tanggal_pengangkatan."')";

                $db->query($sql);

                return $this->respond([
                    "msg"=>"ok", 
                    "data"=>"Data pejabat berhasil ditambah."
                ]);

            }


        }


    }


    public function pejabat_del()
    {

        $pejabat_id = $this->request->getPost("pejabat_id");
        $nama_pejabat = $this->request->getPost("nama_pejabat");
        $tanggal_berhenti = $this->request->getPost("tanggal_berhenti");

        $db = $this->set_db();

        $sql = "select tanggotajemaat.nama, tjabatan.jabatan_id from tpejabat, tjabatan, tanggotajemaat where tpejabat.anggotajemaat_id=tanggotajemaat.anggotajemaat_id and ";
        $sql = $sql . "tpejabat.jabatan_id=tjabatan.jabatan_id and tpejabat.pejabat_id=".$pejabat_id;

        // echo($sql);

        $query = $db->query($sql);

        if ($query) {

            $result = $query->getRow();

            $nama = $result->nama;
            $jabatan_id = $result->jabatan_id;

            $sql = "select historypejabat_id, tanggal_berhenti from thistorypejabat where nama='".$nama_pejabat."' and jabatan_id=".$jabatan_id." and tanggal_berhenti is null";
            
            $query = $db->query($sql);

            if ($query) {

                $result = $query->getRow();

                $sql = "update thistorypejabat set tanggal_berhenti='".$tanggal_berhenti."' where historypejabat_id=".$result->historypejabat_id;

                $db->query($sql);

                $sql = "delete from tpejabat where pejabat_id=".$pejabat_id;

                $db->query($sql);
                
                return $this->respond([
                        "msg"=>"ok", 
                        "data"=>"Data pejabat berhasil dihapus."
                ]);

            }


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