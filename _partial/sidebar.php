<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Project Topsis<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Data Master
	</div>

	<!-- Nav Item - Charts -->
	<li class="nav-item <?php if($_GET['halaman'] == "kriteria") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=kriteria">
			<i class="fas fa-edit"></i>
			<span>Kriteria</span></a>
	</li>

	<li class="nav-item <?php if($_GET['halaman'] == "barang") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=barang">
			<i class="fas fa-edit"></i>
			<span>Barang</span></a>
	</li>

	<li class="nav-item <?php if($_GET['halaman'] == "topsis") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=topsis">
			<i class="fas fa-user"></i>
			<span>Topsis</span></a>
	</li>

	
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
