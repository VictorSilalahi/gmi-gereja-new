<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayan | Administrasi</title>
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>jabatan">Pelayanan</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>organisasi">Seksi</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kegiatan">Program Kerja</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kebaktian">Kebaktian</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>fasilitas">Fasilitas</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>report/sektor">Report</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>seting">Seting</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>logout"><span class="badge text-bg-danger">Logout</span></a>


                            </div>

                          </div>
                        </div>
                      </nav>
                </header>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>

                </div>



                <div class="row">

                  <hr>
                  <h3><span class="badge bg-secondary">Data Anggota Pelayan</span></h3>

                  <div class="row align-self-end">
                    
                    <div class="mb-3 row">
                      <label class="col-form-label col-sm-2">Nama Pelayan:</label>

                      <div class="col-sm-3">
                        <select class="form-control" id="slcPelayan">
                          <option value="Asisten">Asisten</option>
                          <option value="Lay Leader">Lay Leader</option>
                          <option value="Lay Speaker">Lay Speaker</option>
                          <option value="Bendahara">Bendahara</option>
                          <option value="Majelis">Majelis</option>
                          <option value="Guru SM">Guru SM</option>
                        </select>
                      </div>

                    </div>

                  </div>

                  <hr>

                  <div class="row">

                    <div class="mb-3 row">

                      <div class="col-sm-3">
                        <label>Nama Calon Pelayan</label>
                        <input type="text" id="txtNamaCalonPelayan" />
                      </div>

                      <div class="col-sm-3">
                        <label>Pilih nama pelayan</label>
                        <select class="form-control" id="slcFormPelayan">
                          <option value="Asisten">Asisten</option>
                          <option value="Lay Leader">Lay Leader</option>
                          <option value="Lay Speaker">Lay Speaker</option>
                          <option value="Bendahara">Bendahara</option>
                          <option value="Majelis">Majelis</option>
                          <option value="Guru SM">Guru SM</option>
                        </select>
                      </div>

                      <div class="col-sm-3">
                        <label>Tanggal Pengangkatan</label>
                        <input type="date" id="tglPengangkatan" onkeydown="return false" />
                      </div>


                      <div class="col-sm-3">
                        <button class="btn btn-primary btn-ok-tambah-anggota-pelayan">Tambah Anggota Pelayan</button>
                      </div>

                    </div>


                  </div>

                  <div class="row">
                    <table class="table" id="tblPejabat">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Nama Pelayan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                  
                </div>
                


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>

    <div class="modal fade" id="frmBerhentiJabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="opOrganisasi"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label class="col-form-label">Tanggal Berhenti:</label>
                <input type="date" class="form-control" id="txtTanggalBerhenti" onkeydown="return false" >
              </div>
              <input type="hidden" value="" id="nama_pejabat">
              <input type="hidden" value="" id="pejabat_id">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnBerhentiJabatan">OK</button>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">

</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/jabatan.js" type="module"></script>

</html>