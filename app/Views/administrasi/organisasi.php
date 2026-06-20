<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisasi | Administrasi</title>
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<body>
    <div class="container-fluid">

        <div class="row">

            <div class="col-1">
            </div>
            <div class="col-10">
                
                <header>
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="home">Home</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-link" href="<?php echo(base_url()); ?>jemaat">Jemaat</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>sektor">Sektor</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>jabatan">Jabatan</a>
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>organisasi">Organisasi</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>kegiatan">Kegiatan</a>
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
                    <div class="col-3">
                      <button type="button" class="btn btn-primary" id="btnTambahOrganisasi">Tambah Organisasi</button>
                    </div>

                </div>


                <div class="row">

                  <table class="table" id="tblOrganisasi">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td><button type="button" class="btn btn-secondary">Edit</button>&nbsp;<button type="button" class="btn btn-danger">Hapus</button></td>
                      </tr>
                    </tbody>
                  </table>                  

                </div>

                <div class="row">

                  <hr>
                  <h3><span class="badge bg-secondary">Data Anggota Organisasi</span></h3>
                  <div class="row">
                    <div class="mb-3 row">
                      <label for="txtNamaCalonAnggota" class="col-form-label col-sm-1">Nama:</label>
                      <div class="col-sm-4">
                        <input class="form-control" id="txtNamaCalonAnggota">
                      </div>

                      <label for="slcOrganisasiForm" class="col-form-label col-sm-1">Organisasi:</label>
                      <div class="col-sm-4">
                        <select class="form-control" id="slcOrganisasiForm">
                        </select>
                      </div>

                      <button type="button" class="btn btn-info col-sm-2 btn-ok-tambah-anggota-organisasi">Tambah</button>

                    </div>
                  </div>
                  <div class="row">
                    <table class="table" id="tblAnggotaOrganisasi">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Organisasi</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  
                </div>
                


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>

    <div class="modal fade" id="AddEditOrganisasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="opSektor">New message</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="txtNIDN" class="col-form-label">Nama Organisasi:</label>
                <input type="text" class="form-control" id="txtNamaOrganisasi">
              </div>
              <input type="hidden" value="" id="txtJenisOpOrganisasi">
              <input type="hidden" value="" id="txtOrganisasiID">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnOKOrganisasi">OK</button>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">

</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/organisasi.js" type="module"></script>

</html>