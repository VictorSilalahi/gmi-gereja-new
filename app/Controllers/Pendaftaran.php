<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Ramsey\Uuid\Uuid;

class Pendaftaran extends BaseController
{
    
    use ResponseTrait;


    public function index()
    {
        return view('daftar/daftar');
    }


    public function terima_kasih()
    {
        return view('daftar/terima_kasih');        
    }


    public function cek_email()
    {

        $db = \Config\Database::connect();

        $jenis = $this->request->getPost("jenis");
        $email = $this->request->getPost("email");

        if ($jenis=='gereja') {

            $query = $db->query("select count(*) as jumlah from tgereja where email='".$email."'");
    
        } else {

            $query = $db->query("select count(*) as jumlah from tpendeta where email='".$email."'");

        }
        
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan email", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan email", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }


    }


    public function cek_gereja()
    {

        $db = \Config\Database::connect();

        $resort = $this->request->getPost("gereja");
        $distrik = $this->request->getPost("distrik");

        
        $query = $db->query("select count(*) as jumlah from tresort where nama_resort='".$resort."' and distrik='".$distrik."'");
        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan resort", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);
        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan resort", "pesan"=>"Error operasi!");
            return $this->respond($data, 422);
        }

    
    }    
    

    public function tambah_gereja()
    {

        $db = \Config\Database::connect();

        $now = Time::now(); 

        $uuid = Uuid::uuid4();

        $gereja_id = $uuid->toString();
        $gereja = $this->request->getPost("txtNamaGereja");
        $alamat = $this->request->getPost("txtAlamatResort");
        $distrik = $this->request->getPost("slcDistrik");
        $email_gereja = $this->request->getPost("txtEmailGereja");
        $kondisi_bangunan = $this->request->getPost("slcKondisi");
        $kepemilikan_bangunan = $this->request->getPost("slcKepemilikan");

        helper('text');

        $pwd = random_string('alnum', 8);
        $db_id = "g-".random_string('alnum', 8);

        $img_sk = $this->request->getFile("fileSK");
        $new_img_sk = $img_sk->getRandomName();

        $tanggal_daftar = $now->toDateString();
        $created_at = $now->toDateString();
        $updated_at = $now->toDateString();

        $nama_pendeta = $this->request->getPost("txtNamaPendeta");
        $email_pendeta = $this->request->getPost("txtEmailPendeta");

        // $new_gereja = new ResortModel();

        // $new_data = [
        //     'resort_id'=> $resort_id,
        //     'nama_resort'=> $resort, 
        //     'alamat'=> $alamat,
        //     'distrik'=>$distrik,
        //     'email'=>$email_resort,            
        //     'password'=>$pwd, 
        //     'nama_operator'=>$operator, 
        //     'mobile_phone'=>$mobile_phone, 
        //     'path_sk'=>$new_img_sk, 
        //     'tanggal_daftar'=>$tanggal_daftar, 
        //     'created_at'=>$created_at, 
        //     'updated_at'=>$updated_at
        // ];

        // pindahkan file ke folder
        $img_sk->move(ROOTPATH . 'public/uploads/pendeta', $new_img_sk);
        // path penyimpanan image SK
        $path_img_sk = 'public/uploads/pendeta/'.$new_img_sk;
        
        // simpan ke tgereja 
        $sql = "insert into tgereja (gereja_id, distrik, email, password, nama_gereja, alamat, kondisi_bangunan, kepemilikan, db_id, created_at, updated_at)";
        $sql = $sql . " values ('".$gereja_id."','".$distrik."','".$email_gereja."','".$pwd."','".$gereja."','".$alamat."','".$kondisi_bangunan."','".$kepemilikan_bangunan."','".$db_id."'";
        $sql = $sql . ",'".$created_at."','".$updated_at."')";

        $db->query($sql);

        // simpan ke tpendeta 
        $sql = "insert into tpendeta (nama, email) values ('".$nama_pendeta."','".$email_pendeta."')";

        $db->query($sql);

        try {

            $this->kirim_email($email_gereja, $pwd);
            return redirect()->to('daftar/terima_kasih');

        } catch (\Exception $e) {
            
            // Standard exceptions
            log_message('error', $e->getMessage());
        
        }
    }
    
    public function buat_database($db_id)
    {


    }

    public function kirim_email($email_gereja, $pwd)
    {

        $email = \Config\Services::email();

        $pengirim = getenv('email.SMTPUser');

        $email->setFrom($pengirim, "Riset & Pengembangan | GMI Wil-I");
        $email->setTo($email_gereja);
        $email->setSubject('Status Pendaftaran Resort GMI Wil-I');

        $message = '<!DOCTYPE html>';
        $message = $message . '<html lang="en">';
        $message = $message . '<head>';
        $message = $message . '<meta charset="UTF-8">';
        $message = $message . '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $message = $message . '<title>Research and Development GMI Wil-I</title>';
        $message = $message . '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">';
        $message = $message . '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">';
        $message = $message . '</head>';
        $message = $message . '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>';
        $message = $message . '<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>';
        $message = $message . '<body>';
        $message = $message . '<div class="container-fluid">';
        $message = $message . '     <div class="row">';
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '         <div class="col-4">';
        $message = $message . '             <p><h2>Proses Pendaftaran telah selesai.</h2></p>';
        $message = $message . '             <p>Anda dapat melakukan login ke aplikasi dengan menggunakan keterangan di bawah ini:</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Link: https://app.gmiwilayah1.org</p>';
        $message = $message . '             <p>Login: ' .$email_gereja. '</p>';
        $message = $message . '             <p>Password: ' .$pwd. '</p>';
        $message = $message . '             <hr>';
        $message = $message . '             <p>Catatan: password dapat di ubah di dalam aplikasi melalui menu Seting > Password</p>';
        $message = $message . '         </div>';    
        $message = $message . '         <div class="col-4"></div>';
        $message = $message . '     </div>';
        $message = $message . '</div>';
        $message = $message . '</body>';
        $message = $message . '</html>';

        $email->setMessage($message);
        $email->setMailType('html');  


        if ($email->send()) {

            // return view('terima_kasih');    
            return redirect()->to('terima_kasih');

        } else {

            error_log($this->email->print_debugger());
            echo($email->printDebugger(['headers', 'subject', 'body']));
    
        }


    }


    
}

