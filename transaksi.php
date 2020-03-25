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
    <link href="assets/template/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <script src="assets/js/sweetalert.js"></script>

    <title>Project Topsis</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand">Project Topsis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "transaksi") {echo"active";} ?>" href="?halaman=transaksi">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Prioritas Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "topsis") {echo"active";} ?>" href="?halaman=topsis">Perhitungan Topsis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "master") {echo"active";} ?>" href="?halaman=master">Master</a>
            </li>
        </ul>
    </div>
</nav>
    <?php 
                if(!isset($_GET['halaman'])) {
                        error_reporting(0);
                    }
                    if ($_GET['halaman'] == 'master') {
                        include "system/master/data_master/tampil.php";
                    }
                    if ($_GET['halaman'] == 'transaksi') {
                        include "system/transaksi/keranjang_transaksi/tampil.php";
                    }
                    if ($_GET['halaman'] == 'topsis') {
                        include "system/transaksi/perhitungan_topsis/tampil.php";
                    }
                ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/template/sb_admin_2/vendor/jquery/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/template/sb_admin_2/vendor/datatables/jquery.dataTables.min.js"> </script>
    <script src="assets/template/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/template/sb_admin_2/js/demo/datatables-demo.js"></script>
    <!-- Agar input tidak ada history -->
    <script>
        $("form :input").attr("autocomplete", "off");

    </script>
    <!-- Format Rupiah -->
    <script src="assets/js/jquery.mask.js"></script>


    <script>
        $('#dataTable').DataTable({
            ordering: false
        });
        $('#dataTable2').DataTable({
            ordering: false
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.rupiah').mask('000.000.000', {
                reverse: true
            });
        })

    </script>


</body>

</html>