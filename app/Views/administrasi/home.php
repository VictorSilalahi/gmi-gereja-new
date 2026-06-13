<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Administrasi</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<body>

    <div class="container-lg">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                <div class="row">
                    <div class="col-sm-12">
                        <div style="background-image: url(../static/images/bg4.png); width: 100%; height: 950px; background-repeat: no-repeat; background-size: cover;">


                            <div class="row">
                                <div class="col-3" style="margin: 20px;">

                                        <div class="card" id="cardJemaat" style="visibility: hidden;">
                                            <div class="card-header"><h4>Jemaat</h4></div>
                                            <div class="card-body">

                                                <div class="btn-group-vertical" role="group" style="width:100%">
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/jemaat">Jemaat</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/sektor">Sektor</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/jabatan">Jabatan</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/organisasi">Organisasi</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/kegiatan">Kegiatan</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/seting">Seting</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/administrasi/report/sektor">Report</a></button>
                                                </div>

                                            </div>
                                        </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-3" style="margin: 20px;">

                                        <div class="card" id="cardKeuangan" style="visibility: hidden;">
                                            <div class="card-header"><h4>Keuangan</h4></div>
                                            <div class="card-body">
                                                <div class="btn-group-vertical" role="group" style="width:100%">
                                                    <button type="button" class="btn btn-outline-primary"><a href="/keuangan/pemasukan/persembahan">Pemasukan</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/keuangan/pengeluaran">Pengeluaran</a></button>
                                                    <button type="button" class="btn btn-outline-primary"><a href="/keuangan/report">Report</a></button>
                                                </div>
                                            </div>
                                        </div>
                                </div>                                

                            </div>

                            <div class="row">

                                <div class="col-3" style="margin: 20px;">

                                        <div class="card" id="cardAsset" style="visibility: hidden;">
                                            <div class="card-header"><h4>Asset</h4></div>
                                            <div class="card-body">
                                                <div class="btn-group-vertical" role="group" style="width:100%">
                                                    <button type="button" class="btn btn-outline-primary">Jenis Asset</button>
                                                    <button type="button" class="btn btn-outline-primary">Lokasi</button>
                                                    <button type="button" class="btn btn-outline-primary">Input</button>
                                                    <button type="button" class="btn btn-outline-primary">Report</button>
                                                </div>
                                            </div>
                                        </div>

                                </div>                                

                            </div>



                        </div>

                    </div>

                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="{{ url_for('static', filename='administrasi/home.js') }}" type="module"></script>

</html>