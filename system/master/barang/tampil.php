<!--  -->
<?php 
if(isset($_POST['simpan']))
{
    $nama_barang = $_POST['nama_barang'];
    $tingkat_kesulitan = $_POST['tingkat_kesulitan'];
    $harga = $_POST['harga'];
    $query_insert = mysqli_query($koneksi, "INSERT INTO barang (id_barang,nama_barang,tingkat_kesulitan,harga) VALUES (NULL,'$nama_barang','$tingkat_kesulitan','$harga') ");
    if ($query_insert) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}

if(isset($_POST['update']))
{
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $tingkat_kesulitan = $_POST['tingkat_kesulitan'];
    $harga = $_POST['harga'];
    $query_update = mysqli_query($koneksi,"UPDATE barang SET nama_barang='$nama_barang',tingkat_kesulitan='$tingkat_kesulitan',harga='$harga' WHERE id_barang='$id_barang'");
    if ($query_update) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    if ($query_hapus) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan harga barang" required>
                                </div>
                            </div>
						</div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-sm btn-success">Simpan</button>
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
							<th class="text-center">Tingkat Kesulitan</th>
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
							<td><?php echo $data['tingkat_kesulitan'] ?></td>
							<td><?php echo $data['harga'] ?></td>
							<td class="text-center">
                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                        data-target="#modal-edit<?= $data['id_barang'] ?>">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=kriteria&hapus=<?= $data['id_barang'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td> 
						</tr>
                    <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php foreach($query as $data):  ?>
<div id="modal-edit<?=$data['id_barang'];?>" class="modal fade">
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
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan harga barang" value="<?php echo $data['harga'] ?>" required>
                    </div>
                </div>
            </div>
			<div class="modal-footer">
				<button type="submit" name="update" class="btn btn-sm btn-success">Update</button>
				<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
