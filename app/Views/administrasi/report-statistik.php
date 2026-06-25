<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report | Statistik | Administrasi</title>
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<body>
    <div class="container-fluid">

        <div class="row">

            <div class="col-1">
            </div>
            <div class="col-10">
                
                <header>
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="../home">Home</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>sektor">Sektor</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>jabatan">Jabatan</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>organisasi">Organisasi</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kegiatan">Kegiatan</a>
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>report/sektor">Report</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>seting">Seting</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>logout"><span class="badge text-bg-danger">Logout</span></a>


                            </div>

                          </div>
                        </div>
                      </nav>
                </header>

                <div class="row">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/sektor">Sektor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/jabatan">Jabatan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/kelompokumur">Kelompok Umur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/statuskeanggotaan">Status Keanggotaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/ulangtahun">Ulang Tahun</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/pernikahan">Pernikahan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>report/statistik">Statistik</a>
                            </li>
                        </ul>                    


                </div>

                <br><br>

                <div class="row">


                    <div class="card">
                      <div class="card-header">
                        Informasi Jumlah Jemaat
                      </div>
                      <div class="card-body">
                        <div style="height: 150px;">
                          <h1>Jumlah KK: <span class="badge bg-primary" id="bgKK"></span></h1>
                          <h1>Jumlah Jiwa: <span class="badge bg-warning text-dark" id="bgJiwa"></span></h1>

                        </div>
                      </div>
                    </div>                  


                </div>

                <div class="row">
                  <div class="col-6">

                    <div class="card">
                      <div class="card-header">
                        Grafik Kelompok Umur
                      </div>
                      <div class="card-body">
                        <div style="height: 300px;">
                          <canvas id="KelompokUmur"></canvas>
                        </div>
                      </div>
                    </div>                  
                  </div>
                  <div class="col-6">
                    <div class="card">
                      <div class="card-header">
                        Grafik Jemaat Per Sektor
                      </div>
                      <div class="card-body">
                        <div style="height: 400px;">
                          <canvas id="JemaatPerSektor"></canvas>
                        </div>
                      </div>
                    </div>                                    
                    
                  </div>

                </div>

                <div class="row">

                  <div class="col-6">
                    <div class="card">
                      <div class="card-header">
                        Grafik Tipe Keanggotaan
                      </div>
                      <div class="card-body">
                        <div style="height: 500px;">
                          <canvas id="TipeKeanggotaan"></canvas>
                        </div>
                      </div>
                    </div>                  
                  </div>
                  <div class="col-6">
                    <div class="card">
                      <div class="card-header">
                        Grafik Sifat Keanggotaan
                      </div>
                      <div class="card-body">
                        <div style="height: 500px;">
                          <canvas id="SifatKeanggotaan"></canvas>
                        </div>
                      </div>
                    </div>                  
                  </div>

                </div>


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>

    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">

</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/report-statistik.js" type="module"></script>

</html>