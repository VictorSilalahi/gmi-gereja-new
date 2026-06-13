<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sektor | Administrasi</title>
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
                              <a class="nav-link active" aria-current="page" href="/administrasi/sektor">Sektor</a>
                              <a class="nav-link" href="/administrasi/jabatan">Jabatan</a>
                              <a class="nav-link" href="/administrasi/organisasi">Organisasi</a>
                              <a class="nav-link" href="/administrasi/kegiatan">Kegiatan</a>
                              <a class="nav-link" href="/administrasi/report/sektor">Report</a>
                              <a class="nav-link" href="/administrasi/seting">Seting</a>
                              <a class="nav-link" href="/administrasi/logout"><span class="badge text-bg-danger">Logout</span></a>


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
                      <button type="button" class="btn btn-primary" id="btnTambahSektor">Tambah Sektor</button>
                    </div>

                </div>


                <div class="row">

                  <table class="table" id="tblSektor">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Sektor</th>
                        <th scope="col">Nama Daerah Sektor</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td><button type="button" class="btn btn-secondary">Edit</button>&nbsp;<button type="button" class="btn btn-danger">Hapus</button></td>
                      </tr>
                    </tbody>
                  </table>                  

                </div>


            </div>
            <div class="col-1">
            </div>

        </div>

    </div>

    <div class="modal fade" id="AddEditSektor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="opSektor">New message</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="txtNIDN" class="col-form-label">No Sektor:</label>
                <input type="text" class="form-control" id="txtNomorSektor">
              </div>
              <div class="mb-3">
                <label for="txtNIDN" class="col-form-label">Nama Daerah Sektor:</label>
                <input type="text" class="form-control" id="txtNamaSektor">
              </div>
              <input type="hidden" value="" id="txtJenisOpSektor">
              <input type="hidden" value="" id="txtSektorID">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnOKSektor">OK</button>
          </div>
        </div>
      </div>
    </div>

</body>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ url_for('static', filename='administrasi/sektor.js') }}" type="module"></script>

</html>