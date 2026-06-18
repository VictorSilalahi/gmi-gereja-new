<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jemaat | Administrasi</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<style>
  .nick:hover {
    background-color: yellow;
    font-weight: bold;
    cursor: grabbing;
  }
  
  .modal-super-big {
    max-width: 95%; /* Adjust percentage as needed */
    width: 95%;
  }

</style>
<body>
    <div class="container-fluid">

        <div class="row">

            <div class="col-1">
            </div>
            <div class="col-10">
                
                <header>
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="#">
                            SIGMI
                          </a>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-link active" aria-current="page" href="<?php echo(base_url()); ?>jemaat">Jemaat</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>sektor">Sektor</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>jabatan">Jabatan</a>
                              <a class="nav-link" href="<?php echo(base_url()); ?>organisasi">Organisasi</a>
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
                    <div class="col-3">
                        <label class="col-form-label" for="slcSektor">Sektor:</label>
                        <div class="">
                          <select class="form-select" aria-label="Default select example" id="slcSektor">
                          </select>
                        </div>

                    </div>
                    <div class="col-3">
                      <br>
                      <button type="button" class="btn btn-primary" id="btnTambahJemaat">Tambah Jemaat</button>

                    </div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <label class="col-form-label" for="slcSektor">Jumlah:</label>
                        <span class="badge text-bg-warning">
                          <p class="fs-1" id="pJumlahJemaat">0</p>
                        </span>
                    </div>

                </div>

                <div>
                  <br>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3">
                    </div>

                </div>


                <div class="row">

                  <table class="table" id="tblJemaat">
                    <thead>
                      <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Mobile Phone</th>
                        <th scope="col">Pimpinan Keluarga</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jumlah Anggota Keluarga</th>
                        <th scope="col">Status Keanggotaan</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>Mark</td>
                        <td>Otto</td>
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

    <div class="modal fade" id="AddEditJemaat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-super-big">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="opJemaat">New message</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form>

              <div class="mb-3 row">
                <label for="slcSektorForm" class="col-form-label col-sm-1">Sektor:</label>
                <div class="col-sm-2">
                  <select class="form-control" aria-label="Default select example" id="slcSektorForm">

                  </select>
                </div>

                <label for="txtNIK" class="col-form-label col-sm-1">NIK:</label>
                <div class="col-sm-1">
                  <input type="text" class="form-control" id="txtNIKAwal">
                </div>
                -
                <div class="col-sm-1">
                  <input type="text" class="form-control" id="txtNIKAkhir">
                </div>


                <label for="txtDaftarJemaat" class="col-form-label col-sm-1">Tanggal Terdaftar:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalTerdaftar">
                </div>

                <label for="txtMobilePhone" class="col-form-label col-sm-1">Mobile Phone:</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="txtMobilePhone">
                </div>


                <label for="txtAlamat" class="col-form-label col-sm-1">Alamat:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="txtAlamat">
                </div>

                <label for="slcStatus" class="col-form-label col-sm-1">Status Keanggotaan:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcStatus">
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                </div>


              </div>

              <hr style="border: 2px solid rgb(40, 43, 40); border-radius: 2px;">

              <div class="mb-3 row">
                <label for="txtNama" class="col-form-label col-sm-1">Nama:</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="txtNama">
                </div>

                <label for="slcJenisKelamin" class="col-form-label col-sm-1">Jenis Kelamin:</label>
                <div class="col-sm-1">
                  <select id="slcJenisKelamin">
                    <option value="L">L</option>
                    <option value="P">P</option>
                  </select>
                </div>

                <label for="slcGolonganDarah" class="col-form-label col-sm-1">Golongan Darah:</label>
                <div class="col-sm-1">
                  <select id="slcGolonganDarah">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                  </select>
                </div>

                <label for="txtTanggalLahir" class="col-form-label col-sm-1">Tanggal Lahir:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalLahir">
                </div>
                
                <hr>

                <label for="txtTanggalBaptis" class="col-form-label col-sm-1">Tanggal Baptis:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalBaptis">
                </div>

                <label for="txtTanggalSidi" class="col-form-label col-sm-1">Tanggal Sidi:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalSidi">
                </div>

                <label for="txtTanggalMenikah" class="col-form-label col-sm-1">Tanggal Menikah:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalMenikah">
                </div>

                <label for="slcPosisi" class="col-form-label col-sm-1">Posisi dalam keluarga:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcPosisi">
                      <option value="Mandiri">Mandiri</option>
                      <option value="Suami">Suami</option>
                      <option value="Istri">Istri</option>
                      <option value="Anak">Anak</option>
                      <option value="AKL">Anggota Keluarga Lainnya</option>
                  </select>
                </div>

                <hr>

                <label for="slcPendidikanTerakhir" class="col-form-label col-sm-1">Pendidikan Terakhir:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcPendidikanTerakhir">
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA-SMK">SMA-SMK</option>
                      <option value="D3">D3</option>
                      <option value="S1">S1</option>
                      <option value="S2">S2</option>
                      <option value="S3">S3</option>
                      <option value="None">None</option>
                  </select>
                </div>
                
                <label for="slcPekerjaan" class="col-form-label col-sm-1">Pekerjaan:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcPekerjaan">
                      <option value="ASN">ASN</option>
                      <option value="TNI-Polri">TNI-Polri</option>
                      <option value="Karyawan-Swasta">Karyawan Swasta</option>
                      <option value="Pedagang">Pedagang</option>
                      <option value="Wiraswasta">Wiraswasta</option>
                      <option value="Dokter">Dokter</option>
                      <option value="Petani">Petani</option>
                      <option value="None">None</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <button type="button" class="btn btn-info btn-tambah-calon-anggota">Input Anggota Keluarga</button>
                </div>
              </div>

              
              <input type="hidden" value="" id="txtJenisOpJemaat">
              <input type="hidden" value="" id="txtJemaatID">

              <hr style="border: 2px solid rgb(40, 43, 40); border-radius: 2px;">

            </form>


          </div>

          <div>

            <table class="table table-striped" id="tblDaftarCalonJemaat">
              <thead>
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">JK</th>
                  <th scope="col">Gol Darah</th>
                  <th scope="col">Lahir</th>
                  <th scope="col">Baptis</th>
                  <th scope="col">Sidi</th>
                  <th scope="col">Menikah</th>
                  <th scope="col">Posisi Keluarga</th>
                  <th scope="col">Pend.Terakhir</th>
                  <th scope="col">Pekerjaan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnOKJemaat">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editJemaatNIK" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Edit Data Umum Jemaat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form>

              <div class="mb-3 row">

                <label for="txtNIK" class="col-form-label col-sm-2">NIK:</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="txtNIKAwalEdit">
                </div>
                -
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="txtNIKAkhirEdit">
                </div>

                <label for="txtMobilePhoneEdit" class="col-form-label col-sm-1">Mobile Phone:</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="txtMobilePhoneEdit">
                </div>


              </div>
              <div class="mb-3 row">
                <label for="txtAlamatEdit" class="col-form-label col-sm-2">Alamat:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="txtAlamatEdit">
                </div>
                <label for="slcStatusEdit" class="col-form-label col-sm-2">Status Keanggotaan Gereja:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcStatusEdit">
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                </div>

              </div>            
              <input type="hidden" id="txtJemaatEdit"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnEditJemaatNIK">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editJemaatAnggota" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="titleShow">Edit Data Anggota Keluarga</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div>

              <div class="mb-3 row" id="formEditJemaat">
                <label for="txtNama" class="col-form-label col-sm-1">Nama:</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="txtNamaEdit">
                </div>

                <label for="slcJenisKelamin" class="col-form-label col-sm-1">Jenis Kelamin:</label>
                <div class="col-sm-1">
                  <select id="slcJenisKelaminEdit">
                    <option value="L">L</option>
                    <option value="P">P</option>
                  </select>
                </div>


                <label for="txtTanggalLahir" class="col-form-label col-sm-1">Tanggal Lahir:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalLahirEdit">
                </div>

                <label for="txtTanggalBaptis" class="col-form-label col-sm-1">Tanggal Baptis:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalBaptisEdit">
                </div>

                <label for="txtTanggalSidiEdit" class="col-form-label col-sm-1">Tanggal Sidi:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalSidiEdit">
                </div>

                <label for="txtTanggalBaptis" class="col-form-label col-sm-1">Tanggal Menikah:</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="txtTanggalMenikahEdit">
                </div>

                <label class="col-form-label col-sm-1">Posisi:</label>
                <div class="col-sm-2">
                  <select class="form-select" aria-label="Default select example" id="slcPosisiEdit">
                      <option value="Mandiri">Mandiri</option>
                      <option value="Suami">Suami</option>
                      <option value="Istri">Istri</option>
                      <option value="Anak">Anak</option>
                      <option value="AKL">Anggota Keluarga Lainnya</option>
                  </select>
                </div>

                <div class="col-sm-3">
                  <button type="button" class="btn btn-info btn-tambah-calon-anggota-edit">Input Anggota Keluarga</button>
                </div>              

                <input type="hidden" id="txtJemaatIDEdit" />
                </div>
            </div>

            <hr style="border: 2px solid rgb(40, 43, 40); border-radius: 2px;">


            <div>

              <table class="table" id="tblDaftarCalonJemaatEdit">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">JK</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Tanggal Baptis</th>
                    <th scope="col">Tanggal Sidi</th>
                    <th scope="col">Tanggal Menikah</th>
                    <th scope="col">Tanggal Wafat</th>
                    <th scope="col">Posisi</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>


            </div>


          </div>
          <div class="modal-footer" id="btnEditDataKeluarga">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnEditJemaatAnggota">OK</button>
          </div>
        </div>
      </div>
    </div>

   <div class="modal" id="modalEditTanggal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditTanggalTitle">Edit Tanggal
                      
                    </h4>
                    <button type="button" class="close close-x" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="container"></div>
                <div class="modal-body">
                    <p>

                      <label class="col-form-label col-sm-2">Tanggal :</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="txtEditTanggal">
                        </div>
                      <input type="hidden" id="txtJenisTanggal">
                      <input type="hidden" id="txtAnggotaJemaatID">
                      
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-close-edit-tanggal">Batal</a>
                    <a href="#" class="btn btn-primary btn-simpan-tanggal-edit">Simpan</a>
                </div>
            </div>
        </div>
    </div>    

   <div class="modal" id="modalShowAnggotaJemaat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditTanggalTitle">Edit Tanggal
                      
                    </h4>
                    <button type="button" class="close close-x" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="container"></div>
                <div class="modal-body">
                    <p>

                      <label class="col-form-label col-sm-2">Tanggal :</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="txtEditTanggal">
                        </div>
                      <input type="hidden" id="txtJenisTanggal">
                      <input type="hidden" id="txtAnggotaJemaatID">
                      
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-close-edit-tanggal">Batal</a>
                    <a href="#" class="btn btn-primary btn-simpan-tanggal-edit">Simpan</a>
                </div>
            </div>
        </div>
    </div>    

    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/jemaat.js" type="module"></script>

</html>