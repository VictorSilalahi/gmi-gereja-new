<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seting | Administrasi</title>
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
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
                              <a class="nav-link" href="<?php echo(base_url()); ?>report/sektor">Report</a>
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>seting">Seting</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>logout"><span class="badge text-bg-danger">Logout</span></a>


                            </div>

                          </div>
                        </div>
                      </nav>
                </header>

                <hr>

                <div class="row">

                  <div class="card">
                    <div class="card-header">
                      <h2>Password</h2>
                    </div>
                    <div class="card-body">


                      <div class="mb-3 row">
                        <label for="txtPassword1" class="col-form-label">Masukkan Password baru:</label>
                        <div class="col-sm-4">
                          <input type="password" class="form-control" id="txtPassword1">
                        </div>
                        <label for="txtPassword2" class="col-form-label">Masukkan Kembali Password baru:</label>
                        <div class="col-sm-4">
                          <input type="password" class="form-control" id="txtPassword2">
                        </div>
                        <br><br>
                        <div>
                          <button class="btn btn-success btn-update-password">Simpan Perubahan Password</button>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                      <h2>Data Gereja</h2>
                    </div>
                    <div class="card-body">

                      <table class="table">
                        <thead>
                          <tr>
                            <td>Field</td>
                            <td>Data</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Nama Gereja</td>
                            <td><input class="form-control" type="text" value="" id="txtNamaGereja"></td>
                            <td><button class="btn btn-success btn-update-nama-gereja">Simpan Perubahan</button></td>
                          </tr>
                          <tr>
                            <td>Alamat Gereja</td>
                            <td><input class="form-control" type="text" value="" id="txtAlamatGereja"></td>
                            <td><button class="btn btn-success btn-update-alamat-gereja">Simpan Perubahan</button></td>
                          </tr>
                          <tr>
                            <td>Provinsi/Kab-Kota</td>
                            <td>
                              <select id="slcProvinsi"></select>
                              <select id="slcKabKota"></select>
                            </td>
                            <td><button class="btn btn-success btn-update-kabkota-gereja">Simpan Perubahan</button></td>
                          </tr>
                        </tbody>
                      </table>

                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                      <h2>Koordinat Lokasi Gereja</h2>
                    </div>
                    <div class="card-body">

                      <div id="map" style="width:100%; height:500px"></div>
                      <br>
                      <div>
                        <button class="btn btn-success float-end btn-update-koordinat-gereja">Simpan Perubahan</button>
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
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/seting.js" type="module"></script>

</html>