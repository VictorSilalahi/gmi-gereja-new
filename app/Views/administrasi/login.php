<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<body>
    <div class="container">

        <div class="row"  style="background-image: url('<?php echo(base_url()); ?>assets/images/gmi3.jpg'); background-size: cover; background-position: center; height: 950px;">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            <p>LOGIN</p>
                        </div>
                        <div class="card-body">

                            <form">
                                <div class="mb-3">
                                <label for="txtEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                <label for="txtPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                                </div>
                                <button type="submit" class="btn btn-primary btn-login">Login</button>
                            </form>                        

                        </div>
                    </div>

                </div>

                
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>
                            <span class="badge bg-warning text-dark CopyRight"></span> 
                    </p>
                </div>

            </div>



        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade modal-dialog-scrollable" id="modalBerita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="judul"></div>
                <hr>
                <p id="deskripsi">

                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/login.js" type="module"></script>

</html>