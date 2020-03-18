<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include "koneksi/koneksi.php";
include "koneksi/function.php";
// if (!isset($_SESSION['username_user'])) {
//     header('location:index.php');
// }
// ?>

<head>

    <!-- Head -->
    <?php include "_partial/head.php"; ?>
    <!-- End of Head -->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "_partial/sidebar.php"; ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "_partial/topbar.php"; ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php 
                if(!isset($_GET['halaman'])) {
                        error_reporting(0);
                    }
                    // if ($_GET['halaman'] == 'dashboard') {
                    //     include "dashboard/dashboard_admin.php";
                    // }
                    // Tutup Dashboard

                    // Parsing halaman Pegawai
                    if ($_GET['halaman'] == 'barang') {
                        include "system/master/barang/tampil.php";
                    }

                    if ($_GET['halaman'] == 'kriteria') {
                        include "system/master/kriteria/tampil.php";
                    }

                    if ($_GET['halaman'] == 'topsis') {
                        include "system/transaksi/perhitungan_topsis/tampil.php";
                    }

                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "_partial/footer.php"; ?>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Js -->
    <?php include "_partial/js.php"; ?>

    <!-- End of Js -->

</body>

</html>