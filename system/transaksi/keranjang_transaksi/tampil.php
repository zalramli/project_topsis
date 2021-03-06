<?php 
if(isset($_POST['simpan']))
{
    if($_POST['grand_total'] != " " )
    {
        if($_POST['grand_total'] != 0)
        {
                $sql = mysqli_query($koneksi, "SELECT max(id_transaksi) FROM transaksi");
                $kode_faktur = mysqli_fetch_array($sql);
                if ($kode_faktur) {
                    $nilai = substr($kode_faktur[0], 1);
                    $kode = (int) $nilai;
                    //tambahkan sebanyak + 1
                    $kode = $kode + 1;
                    $auto_kode = "T" . str_pad($kode, 7, "0",  STR_PAD_LEFT);
                } else {
                    $auto_kode = "T0000001";
                }
                $grand_total_temp = $_POST['grand_total'];
                $grand_total = (int) preg_replace("/[^0-9]/", "", $grand_total_temp);
                date_default_timezone_set("Asia/Jakarta");
                $nama_customer = ucwords(addslashes($_POST['nama_customer']));
                $no_hp = $_POST['no_hp'];
                $tgl_pemesanan = date('Y-m-d');
                $tgl_deadline = date("Y-m-d",strtotime($_POST['tgl_deadline']));
                $sekarang    = new DateTime($tgl_pemesanan);
                $deadline       = new DateTime($tgl_deadline);
                $jarak        = $deadline->diff($sekarang);
                $selisih = $jarak->format('%d');
                $waktu_pengerjaan = $selisih;

                $insert = mysqli_query($koneksi,"INSERT INTO transaksi VALUES('$auto_kode','$tgl_pemesanan','$tgl_deadline','$nama_customer','$no_hp','$grand_total')");
                if($insert)
                {
                    $value_kriteria = [];
                    $tampil_kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
                    $count_kriteria = mysqli_num_rows($tampil_kriteria);

                    $sql2 = mysqli_query($koneksi, "SELECT MAX((SUBSTRING(nama_barang_detail,-10))) FROM detail_transaksi");
                            $kode_faktur2 = mysqli_fetch_array($sql2);
                            if ($kode_faktur2) {
                                $nilai2 = substr($kode_faktur2[0], -10);
                                $kode2 = (int) $nilai2;
                                //tambahkan sebanyak + 1
                                $kode2 = $kode2 + 1;
                                $auto_kode2 = str_pad($kode2, 10, "0",  STR_PAD_LEFT);
                            } else {
                                $auto_kode2 = "0000000001";
                            }
                    

                    for($j=0;$j<$count_kriteria;$j++){
                    $data_kriteria = mysqli_fetch_array($tampil_kriteria);
                        $id_kriteria = $data_kriteria['id_kriteria'];
                        
                        for ($i = 0; $i < count($_POST['id_barang']); $i++) {
                            

                            $id_barang = $_POST['id_barang'][$i];
                            $nama_barang = $_POST['nama_barang_detail'][$i];
                            $nama_barang_detail_temp = $nama_customer.",".$no_hp.",".$nama_barang." ".$auto_kode2;
                            $nama_barang_detail = addslashes($nama_barang_detail_temp);
                            $tingkat_kesulitan = $_POST['tingkat_kesulitan'][$i];
                            $qty_temp =  $_POST['qty'][$i];
                            $qty = (int) $qty_temp;
                            $harga_temp = $_POST['harga'][$i];
                            $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);
                            $value_kriteria = [$tgl_deadline,$waktu_pengerjaan,$harga,$qty,$tingkat_kesulitan];
                            $insert_detail = mysqli_query($koneksi,"INSERT INTO detail_transaksi (id_detail_transaksi,id_transaksi,id_barang,id_kriteria,nama_barang_detail,value_kriteria,status_pengerjaan) VALUES (NULL,'$auto_kode','$id_barang','$id_kriteria','$nama_barang_detail','$value_kriteria[$j]','Belum Selesai')");   
                        }
                        }
                        if($insert_detail)
                        {
                            echo "<script>Swal.fire('Sukses','Transaksi Berhasil','success')
                            .then(function(){
                            window.location = window.location = 'admin.php?halaman=transaksi';
                            });</script>";
                        }
                }
            
        }
        else 
        {
            echo "<script>Swal.fire('Gagal','Daftar belanja kosong','error')
                    .then(function(){
                    window.location = window.location = 'admin.php?halaman=transaksi';
                    });</script>";
        }
    }
    else
    {
        echo "<script>Swal.fire('Gagal','Daftar belanja kosong','error')
                    .then(function(){
                    window.location = window.location = 'admin.php?halaman=transaksi';
                    });</script>";
    }   
}

?>
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
                                $query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");
                                foreach ($query as $data) :
                                    $id_barang = $data['id_barang'];
                                    $nama_barang = $data['nama_barang'];
                                    $harga = $data['harga'];
                                    $tingkat_kesulitan = $data['tingkat_kesulitan'];
                                    ?>
                                    <div class="col-md-4 mb-3">
                                        <div style="padding:0" class="card">
                                            <div class="card-body">
                                                <p style="margin:0" class="text-center">
                                                    <?php echo $nama_barang ?></p>
                                                <p style="margin:0" class="text-center">
                                                    <?php echo rupiah($harga) ?></p>
                                                <div class="text-center">
                                                    <a onclick="tambah('<?php echo $id_barang ?>','<?php echo addslashes($nama_barang) ?>','<?php echo $harga  ?>','<?php echo $tingkat_kesulitan  ?>')"
                                                        class="btn btn-sm btn-danger text-white mt-2">Pilih Barang</a>
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
                            <h5 class="text-center mb-3">Daftar Barang Yang Dibeli</h5>
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
                                        <div class="col-md-6">
                                            Nama Customer
                                        </div>
                                        <div class="col-md-6">
                                            No Handphone
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm"
                                                name="nama_customer" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm"
                                                name="no_hp" required>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            Tanggal Deadline
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            Grand Total
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" id="datepicker" class="form-control form-control-sm"
                                                name="tgl_deadline" required>
                                        </div>
                                        <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm rupiah text-right"
                                                name="grand_total" id="grand_total" value=" " readonly>
                                        </div>
                                    </div>
                                    <tbody>
                                        <tr>
                                            <td><button type="submit" name="simpan"
                                                    class="btn btn-sm btn-success">Simpan Data</button></td>
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

function tambah(kode, nama, harga,tingkat_kesulitan) {
    // You can't define php variables in java script as $course etc.
    $('#detail_list').append(`

                <tr id="row` + count + `" class="kelas_row">
                    <td>
                        ` + nama +
        `
                        <input type="hidden" name="id_barang[]" class="form-control form-control-sm" id="kode_barang` +
        count + `" value="` + kode + `">
        <input type="hidden" name="tingkat_kesulitan[]" class="form-control form-control-sm" id="kode_barang` +
        count + `" value="` + tingkat_kesulitan + `">
        <input type="hidden" name="nama_barang_detail[]" class="form-control form-control-sm" id="kode_barang` +
        count + `" value="` + nama + `">
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
        url: "system/transaksi/keranjang_transaksi/grand_total.php",
        method: "POST",
        data: form_data,
        success: function(data) {
            $('#grand_total').val(data);
            $('.rupiah').trigger('input'); // Will be display 
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

</script>


