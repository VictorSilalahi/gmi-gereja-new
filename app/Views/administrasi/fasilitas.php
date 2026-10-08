<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas | Administrasi</title>
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
                          <a class="navbar-brand" href="home">SIGMI</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>sektor">Sektor</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>jabatan">Pelayanan</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>organisasi">Organisasi</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kegiatan">Program Kerja</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kebaktian">Kebaktian</a>      
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>fasilitas">Fasilitas</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>report/sektor">Report</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>seting">Seting</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>logout"><span class="badge text-bg-danger">Logout</span></a>


                            </div>

                          </div>
                        </div>
                      </nav>
                </header>

                <br>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>

                </div>


                <div class="row">

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Gedung Gereja</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Gedung_Gereja"></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Pastori</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Pastori"></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Gedung Sekolah Minggu</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Gedung_Sekolah_Minggu"></td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>Sekolah</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Sekolah"></td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>Gedung Serba Guna</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Gedung_Serba_Guna"></td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>Lahan Kosong</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Lahan_Kosong"></td>
                      </tr>
                      <tr>
                        <th scope="row">7</th>
                        <td>Pemakaman</td>
                        <td><input class="form-check-input" type="checkbox" value="" id="Pemakaman"></td>
                      </tr>
                    </tbody>
                  </table>                  

                </div>


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>



    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/fasilitas.js" type="module"></script>

</html>