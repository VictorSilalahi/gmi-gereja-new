<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebaktian | Administrasi</title>
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
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>kebaktian">Kebaktian</a>                              
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
                    <div class="col-9"></div>
                    <div class="col-3">
                    </div>

                </div>

                <br>

                <div class="row">
                  <h3>Data Kebaktian Bulan Ini</h3>
                </div>
                <hr>
                <div class="row">

                  <table class="table" id="tblKebaktian">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Ibadah</th>
                        <th scope="col">Data</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>                  

                </div>


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>

    <div class="modal fade" id="AddKebaktian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="opKebaktian">Input Data Kebaktian</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="txtTanggalMinggu"></div>
            <form>
              <div>

                  <table class="table" id="tblInputKebaktian">
                    <thead>
                      <tr>
                        <th scope="col">Sesi Ibadah</th>
                        <th scope="col">Jumlah Kehadiran</th>
                        <th scope="col">Jumlah Persembahan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ibadah I</td>
                        <td><input type="number" value="0" /></td>
                        <td><input type="number" min="1" step="1" max="10000000" value="0" class="uang" /></td>
                      </tr>
                      <tr>
                        <td>Ibadah II</td>
                        <td><input type="number" value="0" /></td>
                        <td><input type="number" min="1" step="1" max="10000000" value="0" class="uang" /></td>
                      </tr>
                      <tr>
                        <td>Ibadah III</td>
                        <td><input type="number" value="0" /></td>
                        <td><input type="number" min="1" step="1" max="10000000" value="0" class="uang" /></td>
                      </tr>
                      <tr>
                        <td>Ibadah IV</td>
                        <td><input type="number" value="0" /></td>
                        <td><input type="number" min="1" step="1" max="10000000" value="0" class="uang" /></td>
                      </tr>
                      <tr>
                        <td>Ibadah V</td>
                        <td><input type="number" value="0" /></td>
                        <td><input type="number" min="1" step="1" max="10000000" value="0" class="uang" /></td>
                      </tr>
                    </tbody>
                  </table>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnOKKebaktian">OK</button>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/kebaktian.js" type="module"></script>

</html>