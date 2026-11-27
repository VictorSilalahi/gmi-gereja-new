<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclaim | GMI Wil-I</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col">

                <nav class="navbar bg-body-tertiary">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="assets/images/logo-gmi.png" alt="Bootstrap" width="40" height="54"  class="d-inline-block align-text-top">
                                <h4>Reclaim | GMI Wil-I | SIGMI</h4>
                        </a>
                    </div>
                </nav>
            
            </div>

            <div class="row">
                <div class="col-2"></div>

                <div class="col-8" id="div_form">
                    <form id="formReclaim" action="<?php echo(base_url()); ?>/" method="post">
                        <div class="row mb-3">
                            &nbsp;&nbsp;&nbsp;&nbsp;<h2>DATA GEREJA</h2>
                        </div>
                        <hr>   
                        <div class="row mb-3">
                            <label for="txtEmailGereja" class="col-sm-8 col-form-label">Email Gereja</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="txtEmailGereja" id="txtEmailGereja">
                            </div>
                        </div>


                        <br>

                        <div>
                            <button type="button" class="btn btn-primary btn_proses">Proses!</button>
                        </div>
                    
                    </form>
                </div>

                <div class="col-2"></div>

            </div>
        
        </div>

    </div>
    
    <input type="hidden" id="base_url" value="<?php echo(base_url()); ?>">
</body>
    <script src="assets/js/reclaim/reclaim.js" type="module"></script>

</html>