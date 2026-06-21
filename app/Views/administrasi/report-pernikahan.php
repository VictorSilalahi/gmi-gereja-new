<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report | Pernikahan | Administrasi</title>
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
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3">
                      
                    </div>

                </div>


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
                                <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>report/pernikahan">Pernikahan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo(base_url()); ?>report/statistik">Statistik</a>
                            </li>
                        </ul>                    


                </div>

                <br>

                <div class="row">
                  
                  <div class="col-md-1"></div>
                  <div class="col-md-10">

                    <div class="mb-3 row">
                        <label class="col-sm-1">Range Tanggal Awal</label>
                        <div class="col-sm-3">
                          <input type="date" id="tglAwal" class="col-form-label">
                        </div>
                        &nbsp;
                        <label class="col-sm-1">Range Tanggal Akhir</label>
                        <div class="col-sm-3">
                          <input type="date" id="tglAkhir" class="col-form-label">
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-sm-2">
                          <button class="btn btn-info btn-prosesdata">Proses Data</button>
                        </div>
                        <div class="col-sm-1">
                          <button class="btn btn-success btn-print">Print!</button>
                        </div>
                    </div>

                    <br>

                    <div class="row">

                      <div id="bodyReport">
                        <div id="headerReport">
                        </div>
                        <table class="table" id="tblJemaat">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Tanggal Menikah</th>
                              <th scope="col">Alamat</th>
                              <th scope="col">Sektor</th>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="{{ url_for('static', filename='administrasi/report-pernikahan.js') }}" type="module"></script>

</html>