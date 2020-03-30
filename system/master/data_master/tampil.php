<?php 
if(isset($_POST['simpan_barang']))
{
    $nama_barang = addslashes($_POST['nama_barang']);
    $tingkat_kesulitan = $_POST['tingkat_kesulitan'];
    $harga_temp = $_POST['harga'];
    $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);
    $query_insert_barang = mysqli_query($koneksi, "INSERT INTO barang (id_barang,nama_barang,tingkat_kesulitan,harga) VALUES (NULL,'$nama_barang','$tingkat_kesulitan','$harga') ");
    if ($query_insert_barang) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}

if(isset($_POST['update_barang']))
{
    $id_barang = $_POST['id_barang'];
    $nama_barang = addslashes($_POST['nama_barang']);
    $tingkat_kesulitan = $_POST['tingkat_kesulitan'];
    $harga_temp = $_POST['harga'];
    $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);
    $query_update_barang = mysqli_query($koneksi,"UPDATE barang SET nama_barang='$nama_barang',tingkat_kesulitan='$tingkat_kesulitan',harga='$harga' WHERE id_barang='$id_barang'");
    if ($query_update_barang) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}
if (isset($_GET['hapus_barang'])) {
    $id = $_GET['hapus_barang'];
    $query_hapus_barang = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    if ($query_hapus_barang) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}

if(isset($_POST['simpan_kriteria']))
{
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];
    $query_insert_kriteria = mysqli_query($koneksi, "INSERT INTO kriteria (id_kriteria,nama_kriteria,atribut,bobot) VALUES (NULL,'$nama_kriteria','$atribut','$bobot') ");
    if ($query_insert_kriteria) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}

if(isset($_POST['update_kriteria']))
{
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];
    $query_update_kriteria = mysqli_query($koneksi,"UPDATE kriteria SET nama_kriteria='$nama_kriteria',atribut='$atribut',bobot='$bobot' WHERE id_kriteria='$id_kriteria'");
    if ($query_update_kriteria) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}

if (isset($_GET['hapus_kriteria'])) {
    $id = $_GET['hapus_kriteria'];
    $query_hapus_kriteria = mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$id'");
    if ($query_hapus_kriteria) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=master';
		});</script>";
    }
}

?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
                                data-target=".bd-example-modal-lg-barang">Tambah</button>
                            <div class="modal fade bd-example-modal-lg-barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Daftar Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Nama Barang </label>
                                                    <input type="text" name="nama_barang"
                                                        class="form-control form-control-sm" id="inputEmail2"
                                                        placeholder="Masukan nama barang" required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Tingkat Kesulitan </label>
                                                    <select name="tingkat_kesulitan" id="" class="form-control form-control-sm" required>
                                                        <option value="1">Sangat Mudah</option>
                                                        <option value="2">Mudah</option>
                                                        <option value="3">Sedang</option>
                                                        <option value="4">Susah</option>
                                                        <option value="5">Sangat Susah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Harga </label>
                                                    <input type="text" name="harga"
                                                        class="form-control form-control-sm rupiah" id="inputEmail2"
                                                        placeholder="Masukan harga barang" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="simpan_barang" class="btn btn-sm btn-success">Simpan</button>
                                            <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Kesulitan</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang ASC");
                                    foreach ($query as $data) :
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['nama_barang'] ?></td>
                                            <?php 
                                            if($data['tingkat_kesulitan'] == "1")
                                            {
                                            ?>
                                                <td>Sangat Mudah</td>
                                                
                                            <?php
                                            } 
                                            else if($data['tingkat_kesulitan'] == "2")
                                            {
                                            ?>
                                                <td>Mudah</td>
                                            <?php 
                                            } else if($data['tingkat_kesulitan'] == "3")
                                            {
                                            ?>
                                                <td>Sedang</td>
                                            <?php 
                                            }
                                            else if($data['tingkat_kesulitan'] == "4")
                                            {
                                            ?>
                                                <td>Susah</td>
                                            <?php 
                                            }
                                            else if($data['tingkat_kesulitan'] == "5")
                                            {
                                            ?>
                                                <td>Sangat Susah</td>
                                            <?php 
                                            }
                                            ?>
                                            <td class="text-right"><?php echo rupiah($data['harga']) ?></td>
                                            <td class="text-center">
                                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                        data-target="#modal-edit-barang<?= $data['id_barang'] ?>">Edit</a>
                                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=master&hapus_barang=<?= $data['id_barang'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            </td> 
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Kriteria</h6>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
                                data-target=".bd-example-modal-lg-kriteria">Tambah</button>
                            <div class="modal fade bd-example-modal-lg-kriteria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Daftar Kriteria</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Nama Kriteria </label>
                                                    <input type="text" name="nama_kriteria"
                                                        class="form-control form-control-sm" id="inputEmail2"
                                                        placeholder="Masukan nama kriteria" required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Atribut </label>
                                                    <select name="atribut" id="" class="form-control form-control-sm" required>
                                                        <option value="Benefit">Benefit</option>
                                                        <option value="Cost">Cost</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="inputEmail2">Bobot </label>
                                                    <input type="text" name="bobot"
                                                        class="form-control form-control-sm" id="inputEmail2"
                                                        placeholder="Masukan besar bobot" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="simpan_kriteria" class="btn btn-sm btn-success">Simpan</button>
                                            <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor</th>
                                            <th class="text-center">Nama Kriteria</th>
                                            <th class="text-center">Atribut</th>
                                            <th class="text-center">Bobot</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $query2 = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                                    foreach ($query2 as $data2) :
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data2['nama_kriteria'] ?></td>
                                            <td><?php echo $data2['atribut'] ?></td>
                                            <td><?php echo $data2['bobot'] ?></td>
                                            <td class="text-center">
                                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                        data-target="#modal-edit-kriteria<?= $data2['id_kriteria'] ?>">Edit</a>
                                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=master&hapus_kriteria=<?= $data2['id_kriteria'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            </td> 
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($query as $data):  ?>
<div id="modal-edit-barang<?=$data['id_barang'];?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
			<div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Nama Barang </label>
                        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang'] ?>">
                        <input type="text" name="nama_barang"
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan nama barang" value="<?php echo $data['nama_barang'] ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Tingkat Kesulitan </label>
                        <select name="tingkat_kesulitan" id="" class="form-control form-control-sm" required>
							<option value="1" <?php if($data['tingkat_kesulitan'] == "1"){echo "selected";} ?>>Sangat Mudah</option>
							<option value="2" <?php if($data['tingkat_kesulitan'] == "2"){echo "selected";} ?>>Mudah</option>
							<option value="3" <?php if($data['tingkat_kesulitan'] == "3"){echo "selected";} ?>>Sedang</option>
							<option value="4" <?php if($data['tingkat_kesulitan'] == "4"){echo "selected";} ?>>Susah</option>
							<option value="5" <?php if($data['tingkat_kesulitan'] == "5"){echo "selected";} ?>>Sangat Susah</option>
						</select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Harga </label>
                        <input type="text" name="harga"
                            class="form-control form-control-sm rupiah" id="inputEmail2"
                            placeholder="Masukan harga barang" value="<?php echo rupiah($data['harga']) ?>" required>
                    </div>
                </div>
            </div>
			<div class="modal-footer">
				<button type="submit" name="update_barang" class="btn btn-sm btn-success">Update</button>
				<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php foreach($query2 as $data2):  ?>
<div id="modal-edit-kriteria<?=$data2['id_kriteria'];?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Kriteria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
			<div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Nama Kriteria </label>
                        <input type="hidden" name="id_kriteria" value="<?php echo $data2['id_kriteria'] ?>">
                        <input type="text" name="nama_kriteria"
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan nama kriteria" value="<?php echo $data2['nama_kriteria'] ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Atribut </label>
                        <select name="atribut" id="" class="form-control form-control-sm" required>
                            <option value="Benefit" <?php if($data2['atribut'] == "Benefit") {echo "selected";} ?>>Benefit</option>
                            <option value="Cost" <?php if($data2['atribut'] == "Cost") {echo "selected";} ?>>Cost</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Bobot </label>
                        <input type="text" name="bobot"
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan besar bobot" value="<?php echo $data2['bobot'] ?>" required>
                    </div>
                </div>
            </div>
			<div class="modal-footer">
				<button type="submit" name="update_kriteria" class="btn btn-sm btn-success">Update</button>
				<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
