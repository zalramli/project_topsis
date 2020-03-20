<!doctype html>
<html lang="en">
<?php 
include "koneksi/koneksi.php";
include "koneksi/function.php";
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="assets/js/sweetalert.js"></script>

    <title>Project Topsis</title>
</head>

<body>
<nav style="background-color:#3057C9" class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" style="color:white">Project Topsis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="?halaman=transaksi">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="?halaman=topsis">Perhitungan Topsis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Prioritas Order</a>
            </li>
        </ul>
    </div>
</nav>
    <?php 
                if(!isset($_GET['halaman'])) {
                        error_reporting(0);
                    }
                    // if ($_GET['halaman'] == 'dashboard') {
                    //     include "dashboard/dashboard_admin.php";
                    // }
                    // Tutup Dashboard

                    // Parsing halaman Pegawai
                    if ($_GET['halaman'] == 'transaksi') {
                        include "system/transaksi/keranjang_transaksi/tampil.php";
                    }
                    if ($_GET['halaman'] == 'topsis') {
                        include "system/transaksi/perhitungan_topsis/tampil.php";
                    }
                ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.mask.js"></script>


</body>

</html>