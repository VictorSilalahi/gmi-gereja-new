<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seting | Administrasi</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

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
                              <a class="nav-link" href="/administrasi/jemaat">Jemaat</a>
                              <a class="nav-link" href="/administrasi/sektor">Sektor</a>
                              <a class="nav-link" href="/administrasi/jabatan">Jabatan</a>
                              <a class="nav-link" href="/administrasi/organisasi">Organisasi</a>
                              <a class="nav-link" href="/administrasi/kegiatan">Kegiatan</a>
                              <a class="nav-link" href="/administrasi/report/sektor">Report</a>
                              <a class="nav-link active" aria-current="page" href="/administrasi/seting">Seting</a>
                              <a class="nav-link" href="/administrasi/logout"><span class="badge text-bg-danger">Logout</span></a>


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
                      <h2>Informasi Gereja</h2>
                    </div>
                    <div class="card-body">


                      <div class="mb-3 row">
                        <label for="txtNamaGereja" class="col-form-label">Nama Gereja:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="txtNamaGereja">
                        </div>
                        <label for="txtAlamatGereja" class="col-form-label">Alamat Gereja:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="txtAlamatGereja">
                        </div>
                        <br><br>
                        <label for="txtAlamatGereja" class="col-form-label">Distrik:</label>
                        <div class="col-sm-4">
                          <select class="col-form-label">
                            <option value="D-I">D-I</option>
                            <option value="D-II">D-II</option>
                            <option value="D-III">D-III</option>
                            <option value="D-IV">D-IV</option>
                            <option value="D-V">D-V</option>
                            <option value="D-VI">D-VI</option>
                            <option value="D-VII">D-VII</option>
                            <option value="D-VIII">D-VIII</option>
                            <option value="D-IX">D-IX</option>
                            <option value="D-X">D-X</option>
                            <option value="D-XI">D-XI</option>
                            <option value="D-XII">D-XII</option>
                          </select>
                        </div>
                        <br><br>
                        <div>
                          <button class="btn btn-success btn-update-gereja">Simpan Data Gereja</button>
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

</body>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ url_for('static', filename='administrasi/seting.js') }}" type="module"></script>

</html>