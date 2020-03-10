<!-- Bootstrap core JavaScript-->
<script src="assets/template/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script src="assets/template/sb_admin_2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/template/sb_admin_2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/template/sb_admin_2/js/sb-admin-2.min.js"></script>
<script src="assets/template/sb_admin_2/vendor/datatables/jquery.dataTables.min.js"> </script>
<script src="assets/template/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/template/sb_admin_2/js/demo/datatables-demo.js"></script>
<!-- Agar input tidak ada history -->
<!-- <script>
	$("form :input").attr("autocomplete", "off");

</script> -->
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