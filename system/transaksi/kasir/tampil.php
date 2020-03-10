<?php 
if(isset($_POST['simpan']))
{
    if($_POST['grand_total'] != " " )
    {
        if($_POST['grand_total'] != 0)
        {
            if($_POST['kembali'] != " ")
            {
                $sql = mysqli_query($koneksi, "SELECT max(kode_penjualan) FROM penjualan");
                $kode_faktur = mysqli_fetch_array($sql);
                if ($kode_faktur) {
                    $nilai = substr($kode_faktur[0], 1);
                    $kode = (int) $nilai;
                    //tambahkan sebanyak + 1
                    $kode = $kode + 1;
                    $auto_kode = "P" . str_pad($kode, 6, "0",  STR_PAD_LEFT);
                } else {
                    $auto_kode = "P000001";
                }
                $kode_user = $_SESSION['kode_user'];
                $grand_total_temp = $_POST['grand_total'];
                $bayar_temp = $_POST['bayar'];
                $kembali_temp = $_POST['kembali'];
                $grand_total = (int) preg_replace("/[^0-9]/", "", $grand_total_temp);
                $bayar = (int) preg_replace("/[^0-9]/", "", $bayar_temp);
                $kembali = (int) preg_replace("/[^0-9]/", "", $kembali_temp);
                date_default_timezone_set("Asia/Jakarta");
                $tanggal = Date('Y-m-d');

                $insert = mysqli_query($koneksi,"INSERT INTO penjualan VALUES('$auto_kode','$kode_user','$tanggal','$bayar','$grand_total','$kembali')");
                if($insert)
                {
                    for ($i = 0; $i < count($_POST['kode_barang']); $i++) {
                        $harga_jual_temp = $_POST['harga'][$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);
                        $qty_temp =  $_POST['qty'][$i];
                        $qty = (int) $qty_temp;
                        $sub_total = $harga_jual * $qty;
                        $kode_barang = $_POST['kode_barang'][$i];
                        $insert_detail = mysqli_query($koneksi,"INSERT INTO detail_penjualan (kode_detail_penjualan,kode_penjualan,kode_barang,qty,sub_total) VALUES(NULL,'$auto_kode','$kode_barang','$qty','$sub_total')");
                    }
                        $base_url = "system/transaksi/kasir/cetak_struk.php?cetak=".$auto_kode;
                        echo "<script type='text/javascript'>";
                        echo "window.open('" . $base_url . "','_blank')";
                        echo "</script>";
                        if($insert_detail)
                        {
                            echo "<script>Swal.fire('Sukses','Transaksi Berhasil','success')
                            .then(function(){
                            window.location = window.location = 'kasir.php?halaman=kasir';
                            });</script>";
                        }
                }
            }
            else
            {
                echo "<script>Swal.fire('Gagal','Pastikan total bayar anda benar','error')
                    .then(function(){
                    window.location = window.location = 'kasir.php?halaman=kasir';
                    });</script>";
            }
        }
        else 
        {
            echo "<script>Swal.fire('Gagal','Daftar belanja kosong','error')
                    .then(function(){
                    window.location = window.location = 'kasir.php?halaman=kasir';
                    });</script>";
        }
    }
    else
    {
        echo "<script>Swal.fire('Gagal','Daftar belanja kosong','error')
                    .then(function(){
                    window.location = window.location = 'kasir.php?halaman=kasir';
                    });</script>";
    }   
}

?>
<nav style="background-color:#3057C9" class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" style="color:white">Warung Barokah</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="color:white">
                    <span style="color:white"><?php echo $_SESSION['nama_user'] ?></span>
                </a>
                <div class="dropdown-menu" style="min-width:5em;" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div style="overflow-y: scroll; height:550px; width: auto;">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                $no=1;
                                $query = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori_barang USING(kode_kategori_barang) ORDER BY nama_kategori ASC");
                                foreach ($query as $data) :
                                    $kode = $data['kode_barang'];
                                    $nama = $data['nama_barang'];
                                    $harga_jual = $data['harga_jual'];
                                    ?>
                                    <div class="col-md-4 mb-3">
                                        <div style="padding:0" class="card">
                                            <div class="card-body">
                                                <img width="170" class="mb-2 rounded" height="100"
                                                    src="<?php echo "assets/img/".$data['photo']; ?>">
                                                <p style="margin:0" class="text-center">
                                                    <?php echo $data['nama_barang'] ?></p>
                                                <p style="margin:0" class="text-center">
                                                    <?php echo rupiah($data['harga_jual']) ?></p>
                                                <div class="text-center">
                                                    <a onclick="tambah('<?php echo $kode ?>','<?php echo $nama ?>','<?php echo $harga_jual  ?>')"
                                                        class="btn btn-sm btn-primary text-white mt-2">Pilih Menu</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center mb-3">Daftar Makanan Yang Dibeli</h5>
                            <form method="post" id="myform" action="">
                                <table class="table table-sm" width="100%">
                                    <thead>
                                        <tr>
                                            <td class="text-left" width="36%">Nama</td>
                                            <td class="text-center" width="15%">Qty</td>
                                            <td class="text-right" width="22%">Harga</td>
                                            <td class="text-right" width="22%">Sub Total</td>
                                            <td class="text-right" width="5%">&nbsp</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="label_kosong">
                                            <td colspan="2">
                                                Detail Transaksi Masih Kosong !
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tbody id="detail_list"></tbody>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            Grand Total
                                        </div>
                                        <div class="col-md-4">
                                            Bayar
                                        </div>
                                        <div class="col-md-4">
                                            Kembalian
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm rupiah text-right"
                                                name="grand_total" id="grand_total" value=" " readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm rupiah text-right"
                                                name="bayar" id="bayar" onkeyup="kembalian()" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm rupiah text-right"
                                                name="kembali" id="kembali" value=" " readonly>
                                        </div>
                                    </div>
                                    <tbody>
                                        <tr>
                                            <td><button type="submit" name="simpan"
                                                    class="btn btn-sm btn-primary">Simpan Data</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script>
var count = 0;
var jumlah_detail = 0;

function tambah(kode, nama, harga) {
    // You can't define php variables in java script as $course etc.
    $('#detail_list').append(`

                <tr id="row` + count + `" class="kelas_row">
                    <td>
                        ` + nama +
        `
                        <input type="hidden" name="kode_barang[]" class="form-control form-control-sm" id="kode_barang` +
        count + `" value="` + kode + `">
                    </td>
                    <td>
                        <input type="text" name="qty[]" class="form-control form-control-sm qty" id="qty` + count +
        `" value="1" required>
                    </td>
                    <td>
                        <input type="text" name="harga[]" class="form-control form-control-sm rupiah text-right" id="harga` +
        count + `" placeholder="Harga Tindakan BP" required value="` + harga + `" readonly>
                    </td>
                    <td>  
                        <input type="text" class="form-control form-control-sm rupiah text-right" id="sub_total` +
        count +
        `" readonly required value="` + harga + `"></td>
                    <td>
                        <div class="form-group col-sm-2">
                            <a id="` + count + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris">x
                            </a>
                        </div>
                    </td>
                </tr>

                `);
    count = count + 1;
    jumlah_detail = jumlah_detail + 1;
    cek_jumlah_data_detail_transaksi();
    update_sub();
}

function validasi() {
    $('.rupiah').mask('000.000.000', {
        reverse: true
    });
}

function cek_jumlah_data_detail_transaksi() {

    var x = document.getElementById("label_kosong").style;
    if (jumlah_detail > 0) {

        x.display = "none"; // hidden

    } else {
        x.display = "table-row"; // show
    }
    update_sub();
}

$(document).on('click', '.remove_baris', function() {
    var row_no = $(this).attr("id");
    $('#row' + row_no).remove();

    jumlah_detail = jumlah_detail - 1;

    cek_jumlah_data_detail_transaksi();
    update_sub();
});

function update_sub() {
    // mengambil nilai di dalam form
    var form_data = $('#myform').serialize()

    $.ajax({
        url: "system/transaksi/kasir/grand_total.php",
        method: "POST",
        data: form_data,
        success: function(data) {
            $('#grand_total').val(data);
            $('.rupiah').trigger('input'); // Will be display 
            kembalian();
        }
    });

    validasi();
}
$(document).on('keyup', '.qty', function() {

    var row_id = $(this).attr("id"); // qty_apotek_obat1++
    var row_no = row_id.substring(3); // 1++


    var val_qty = $('#' + row_id).val();

    // sub total
    var harga = $('#harga' + row_no).val();
    var val_harga = parseInt(harga.split('.').join(''));
    $('#sub_total' + row_no).val(val_harga * val_qty);
    $('.rupiah').trigger('input'); // Will be display 
    update_sub();
});

function kembalian() {
    var bayar = document.getElementById("bayar").value;
    var grand_total = document.getElementById("grand_total").value;
    var v_bayar = parseInt(bayar.split('.').join(''));
    var v_grand_total = parseInt(grand_total.split('.').join(''));
    var kembalian = v_bayar - v_grand_total;
    $('#kembali').val(kembalian);
    if (v_bayar > v_grand_total) {
        $('.rupiah').trigger('input'); // Will be display 
    } else if (v_bayar == v_grand_total) {
        $('#kembali').val(0);
    } else {
        $('#kembali').val(" ");
    }

}
</script>