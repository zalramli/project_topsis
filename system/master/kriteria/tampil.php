<!--  -->
<?php 
if(isset($_POST['simpan']))
{
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];
    $query_insert = mysqli_query($koneksi, "INSERT INTO kriteria (id_kriteria,nama_kriteria,atribut,bobot) VALUES (NULL,'$nama_kriteria','$atribut','$bobot') ");
    if ($query_insert) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kriteria';
		});</script>";
    }
}

if(isset($_POST['update']))
{
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];
    $query_update = mysqli_query($koneksi,"UPDATE kriteria SET nama_kriteria='$nama_kriteria',atribut='$atribut',bobot='$bobot' WHERE id_kriteria='$id_kriteria'");
    if ($query_update) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kriteria';
		});</script>";
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$id'");
    if ($query_hapus) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kriteria';
		});</script>";
    }
}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Daftar Kriteria</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
							<th class="text-center">Nama Kriteria</th>
							<th class="text-center">Atribut</th>
							<th class="text-center">Bobot</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                    foreach ($query as $data) :
                        ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $data['nama_kriteria'] ?></td>
							<td><?php echo $data['atribut'] ?></td>
							<td><?php echo $data['bobot'] ?></td>
							<td class="text-center">
                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                        data-target="#modal-edit<?= $data['id_kriteria'] ?>">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=kriteria&hapus=<?= $data['id_kriteria'] ?>" class="btn btn-sm btn-danger">Hapus</a>
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
<div id="modal-edit<?=$data['id_kriteria'];?>" class="modal fade">
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
                        <input type="hidden" name="id_kriteria" value="<?php echo $data['id_kriteria'] ?>">
                        <input type="text" name="nama_kriteria"
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan nama kriteria" value="<?php echo $data['nama_kriteria'] ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Atribut </label>
                        <select name="atribut" id="" class="form-control form-control-sm" required>
                            <option value="Benefit" <?php if($data['atribut'] == "Benefit") {echo "selected";} ?>>Benefit</option>
                            <option value="Cost" <?php if($data['atribut'] == "Cost") {echo "selected";} ?>>Cost</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail2">Bobot </label>
                        <input type="text" name="bobot"
                            class="form-control form-control-sm" id="inputEmail2"
                            placeholder="Masukan besar bobot" value="<?php echo $data['bobot'] ?>" required>
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
