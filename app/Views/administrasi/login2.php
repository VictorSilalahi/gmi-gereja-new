<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gereja | GMI Wil-I</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<body>

    <div class="container-fluid">

        <div class="row">
            <!-- Takes full width on mobile, half on tablets, one-third on desktops -->
            <div class="col-sm-6 vh-100 bg-dark bg-gradient">

                <div class="row" style="height:50px">
                </div>

                <div class="row">
                  
                    <div class="col-md-4 col-lg-4">
                      
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                      <img src="<?php echo(base_url()); ?>assets/images/logo.jpg" class="rounded mx-auto d-block" alt="Rounded corners" style="width:300px;height:300px">
                    </div>
                    <div class="col-md-4 col-lg-4">
                      
                    </div>


                </div>            
            
            </div>
            <div class="col-sm-6">


              <div class="card-body p-md-5 mx-md-4">


                <form method="post" id="formLogin" action="<?php echo(base_url()); ?>validasi">
                  
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="txtEmail" name="txtEmail" class="form-control" />
                    <label class="form-label" for="txtUsername">Email</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="txtPassword" name="txtPassword" class="form-control" />
                    <label class="form-label" for="txtPassword">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3  btn-login" type="button">Log
                      in</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Lupa password?</p>
                    <a href="<?php echo(base_url()); ?>reclaim"><button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning">Klik disini</button></a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Distrik belum terdaftar?</p>
                    <a href="<?php echo(base_url()); ?>daftar"><button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">Klik disini</button></a>
                  </div>

                </form>

              </div>


            </div>
        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
    <script src="assets/js/administrasi/login.js" type="module"></script>

</html>