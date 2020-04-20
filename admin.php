<!doctype html>
<html lang="en">
<?php 
session_start();
include "koneksi/koneksi.php";
include "koneksi/function.php";
if (!isset($_SESSION['username_user'])) {
    header('location:index.php');
} 
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/template/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    
    <script src="assets/js/sweetalert.js"></script>

    <title>DIKADOU</title>
</head>

<body>
<nav style="background:#008989" class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand">DIKADOU</a>
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
                <a class="nav-link <?php if($_GET['halaman'] == "prioritas_order") {echo"active";} ?>" href="?halaman=prioritas_order">Prioritas Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "topsis") {echo"active";} ?>" href="?halaman=topsis">Perhitungan Topsis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "master") {echo"active";} ?>" href="?halaman=master">Master</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($_GET['halaman'] == "user") {echo"active";} ?>" href="?halaman=user">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="return confirm('Yakin ingin logout ?')" href="logout.php">(<?php echo $_SESSION['username_user'] ?>) logout</a>
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
                    if ($_GET['halaman'] == 'user') {
                        include "system/master/user/tampil.php";
                    }
                    if ($_GET['halaman'] == 'transaksi') {
                        include "system/transaksi/keranjang_transaksi/tampil.php";
                    }
                    if ($_GET['halaman'] == 'topsis') {
                        include "system/transaksi/perhitungan_topsis/tampil.php";
                    }
                    if ($_GET['halaman'] == 'prioritas_order') {
                        include "system/transaksi/prioritas_order/tampil.php";
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
    <script src="assets/js/bootstrap-datepicker.js"></script>

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
        $('#dataTable3').DataTable({
            ordering: false
        });
        $('#dataTable4').DataTable({
            ordering: false
        });
        $('#dataTable5').DataTable({
            ordering: false
        });
        $('#dataTable6').DataTable({
            ordering: false
        });
        $('#dataTable7').DataTable({
            ordering: false
        });
        $('#dataTable8').DataTable({
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
    <script>
		var date = new Date();
        date.setDate(date.getDate()+1);

        $('#datepicker').datepicker({ 
            startDate: date
        });
	</script>

</body>

</html>