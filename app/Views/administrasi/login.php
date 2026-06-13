<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
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

                            <form method="post" action="<?php echo(base_url()); ?>administrasi/validasi">
                                <div class="mb-3">
                                <label for="emailDosen" class="form-label">Username/Email</label>
                                <input type="text" class="form-control" id="emailDosen" name="uname" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                <label for="passwordDosen" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordDosen" name="pword">
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
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
</body>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="<?php echo(base_url()); ?>assets/js/administrasi/login.js" type="module"></script>

</html>