<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h6>
		</div>
		<div class="card-body">
		<h5>Laporan Custom</h5>
				<form action="system/transaksi/laporan/custom.php" method="post" target="_blank">
					<div class="row mb-3">
							<div class="col-md-3">
								<input type="date" class="form-control" placeholder="tanggal mulai" name="tgl_mulai"/>
							</div>
							<div class="col-md-1">
								<h6 class="mt-2 text-center">Sampai</h6>
							</div>
							<div class="col-md-3">
								<input type="date" class="form-control" placeholder="tanggal mulai" name="tgl_akhir"/>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-sm btn-success mt-1">Cetak Custom</button>
							</div>
					</div>
				</form>
        <nav class="mb-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Hari Ini</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bulan Ini</a>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <a href="system/transaksi/laporan/hari_ini.php" target="_blank" class="btn btn-sm btn-success mb-3">Cetak Hari</a>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">Kode Penjualan</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Yang Melayani</th>
								<th class="text-center">Total Harga</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $no=1;
                        $query_hari = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user USING(kode_user) WHERE DATE(tanggal_penjualan) = CURDATE() ORDER BY kode_penjualan DESC");
                        foreach ($query_hari as $data_hari) :
                        ?>
							<tr>
                                <td><?php echo $data_hari['kode_penjualan'] ?></td>
                                <td><?php echo tgl_indo($data_hari['tanggal_penjualan']) ?></td>
                                <td><?php echo $data_hari['nama_user'] ?></td>
                                <td class="text-right"><?php echo rupiah($data_hari['total_harga']) ?></td>
							</tr>
                        <?php endforeach; ?>
						</tbody>
					</table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <a href="system/transaksi/laporan/bulan_ini.php" target="_blank" class="btn btn-sm btn-success mb-3">Cetak Bulan</a>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">Kode Penjualan</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Yang Melayani</th>
								<th class="text-center">Total Harga</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $no=1;
                        $query_hari = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user USING(kode_user) WHERE MONTH(tanggal_penjualan) = MONTH(CURDATE()) AND YEAR(tanggal_penjualan) = YEAR(CURDATE()) ORDER BY kode_penjualan DESC");
                        foreach ($query_hari as $data_hari) :
                        ?>
							<tr>
                                <td><?php echo $data_hari['kode_penjualan'] ?></td>
                                <td><?php echo tgl_indo($data_hari['tanggal_penjualan']) ?></td>
                                <td><?php echo $data_hari['nama_user'] ?></td>
                                <td class="text-right"><?php echo rupiah($data_hari['total_harga']) ?></td>
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
