<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Ramsey\Uuid\Uuid;

use Config\Database;

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

        $gereja = $this->request->getPost("gereja");
        $distrik = $this->request->getPost("distrik");
        
        $query = $db->query("select count(*) as jumlah from tgereja where nama_gereja='".$gereja."' and distrik='".$distrik."'");

        if ($query) {
            $result = $query->getResultArray();
            $data = array("status"=>"ok", "judul"=>"cek keberadaan gereja", "jumlah"=>$result[0]['jumlah']);
            return $this->respond($data, 200);

        } else {
            $data = array("status"=>"error", "judul"=>"cek keberadaan gereja", "pesan"=>"Error operasi!");
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
        $alamat = $this->request->getPost("txtAlamatGereja");
        $distrik = $this->request->getPost("slcDistrik");
        $email_gereja = $this->request->getPost("txtEmailGereja");
        $kondisi_bangunan = $this->request->getPost("slcKondisi");
        $kepemilikan_bangunan = $this->request->getPost("slcKepemilikan");

        helper('text');

        $pwd = random_string('alnum', 8);
        $db_id = "g-".random_string('alnum', 6);
        $link_identity_id = random_string('alnum', 12);

        $img_sk = $this->request->getFile("fileSK");
        $new_img_sk = $img_sk->getRandomName();

        $tanggal_daftar = $now->toDateString();
        $created_at = $now->toDateString();
        $updated_at = $now->toDateString();

        $nama_pendeta = $this->request->getPost("txtNamaPendeta");
        $email_pendeta = $this->request->getPost("txtEmailPendeta");

        // pindahkan file ke folder
        $img_sk->move(ROOTPATH . 'public/uploads/pendeta', $new_img_sk);
        // path penyimpanan image SK
        $path_img_sk = 'public/uploads/pendeta/'.$new_img_sk;
        
        // simpan ke tgereja 
        $sql = "insert into tgereja (gereja_id, distrik, email, password, nama_gereja, alamat, kondisi_bangunan, kepemilikan, db_id, link_identity_id, created_at, updated_at)";
        $sql = $sql . " values ('".$gereja_id."','".$distrik."','".$email_gereja."','".$pwd."','".$gereja."','".$alamat."','".$kondisi_bangunan."','".$kepemilikan_bangunan."','".$db_id."'";
        $sql = $sql . ",'".$link_identity_id."','".$created_at."','".$updated_at."')";

        $db->query($sql);

        // simpan ke tpendeta 
        $sql = "insert into tpendeta (nama, email) values ('".$nama_pendeta."','".$email_pendeta."')";

        $db->query($sql);

        $db->close();

        // proses membuat database untuk gereja yg baru
        $this->buat_database_gereja($db_id);

        // kirim email pemberitahuan ke email gereja
        try {

            $this->kirim_email($email_gereja, $pwd);
            return redirect()->to('daftar/terima_kasih');

        } catch (\Exception $e) {
            
            // Standard exceptions
            log_message('error', $e->getMessage());
        
        }
    }
    
    public function buat_database_gereja($db_id)
    {

        $customConfig = [
            'DSN'      => '',
            'hostname' => getenv('database.default.hostname'),
            'username' => getenv('database.default.username'),
            'password' => getenv('database.default.password'),
            'database' => 'g-core',
            'DBDriver' => getenv('database.default.DBDriver'),
            'pConnect' => false,
            'DBDebug'  => true,
            'charset'  => 'utf8mb4',
            'DBCollat' => 'utf8mb4_general_ci',
            'port'     => 3306,
        ];

        // Establish connection using the custom array parameters
        $sourceDb = \Config\Database::connect($customConfig, false);    
        $forge = \Config\Database::forge($sourceDb);

        // Create the new target database
        try {
            if ($forge->createDatabase($db_id)) {
                // echo "Database '{$db_id}' created successfully.<br>";
            }
        } catch (\Exception $e) {

            // Standard exceptions
            log_message('error', $e->getMessage());

        }

        // 4. Create a dynamic connection array for the new database
        $targetConfig = [
            'DSN'      => '',
            'hostname' => getenv('database.default.hostname'),
            'username' => getenv('database.default.username'),
            'password' => getenv('database.default.password'),
            'database' => $db_id,
            'DBDriver' => getenv('database.default.DBDriver'),
            'pConnect' => false,
            'DBDebug'  => true,
            'charset'  => 'utf8mb4',
            'DBCollat' => 'utf8mb4_general_ci',
            'port'     => 3306,
        ];
        
        // // Connect to the newly created database
        $targetDb = \Config\Database::connect($targetConfig, false);

        // // 5. Retrieve all tables from the source database
        $tables = $sourceDb->listTables();

        foreach ($tables as $table) {
            // Ignore system migration tables if you do not want history duplicated
            if ($table === 'migrations') {
                continue;
            }

            // echo "Cloning table: {$table}... ";

            // 6. Duplicate the structure using raw SQL
            // (Note: This syntax is specific to MySQL/MariaDB)
            $targetDb->query("CREATE TABLE `{$db_id}`.`{$table}` LIKE `{$sourceDb->database}`.`{$table}`");

            // 7. Clone data using CodeIgniter 4 Query Builder
            $sourceData = $sourceDb->table($table)->get()->getResultArray();

            if (!empty($sourceData)) {
                // Batch insert into the new clone database table
                $targetDb->table($table)->insertBatch($sourceData);
            }

        }

        return true;    

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

            log_message('error', $this->email->print_debugger());
            // error_log($this->email->print_debugger());
            // echo($email->printDebugger(['headers', 'subject', 'body']));
    
        }


    }


    
}

