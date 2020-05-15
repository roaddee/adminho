<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		tampilPelanggan();
		tampilPelaksana();
		tampilJasa();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	//pelanggan
	function tampilPelanggan() {
		$.get('<?php echo base_url('Pelanggan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pelanggan').html(data);
			refresh();
		});
	}

	var id_pelanggan;
	$(document).on("click", ".konfirmasiHapus-pelanggan", function() {
		id_pelanggan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPelanggan", function() {
		var id = id_pelanggan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pelanggan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPelanggan();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPelanggan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pelanggan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pelanggan').modal('show');
		})
	})

	$('#form-tambah-pelanggan').submit(function(e) {
		e.preventDefault();
		var data = $(this).serialize();

		/* $.ajaxSetup({
      		headers: {
     		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		}); */

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pelanggan/prosesTambah'); ?>',
			data: data
			//success: function(data){console.log(data);}
		})
		//alert(xhr.responseText);
		//console.log(xhr.responseText);
		.done(function(data) {
			var out = JSON.parse(data);

			tampilPelanggan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pelanggan").reset();
				$('#tambah-pelanggan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		// e.preventDefault();
	});

	$(document).on('submit', '#form-update-pelanggan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pelanggan/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPelanggan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pelanggan").reset();
				$('#update-pelanggan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pelanggan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pelanggan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Jasa
	function tampilJasa() {
		$.get('<?php echo base_url('Jasa/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-jasa').html(data);
			refresh();
		});
	}

	var id_jasa;
	$(document).on("click", ".konfirmasiHapus-jasa", function() {
		id_jasa = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataJasa", function() {
		var id = id_jasa;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Jasa/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilJasa();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataJasa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Jasa/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-jasa').modal('show');
		})
	})

	$(document).on("click", ".detail-dataJasa", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Jasa/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-jasa').modal('show');
		})
	})

	$('#form-tambah-jasa').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Jasa/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilJasa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-jasa").reset();
				$('#tambah-jasa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-jasa', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Jasa/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilJasa();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-jasa").reset();
				$('#update-jasa').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-jasa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-jasa').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//pelaksana
	function tampilPelaksana() {
		$.get('<?php echo base_url('Pelaksana/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pelaksana').html(data);
			refresh();
		});
	}

	var id_pelaksana;
	$(document).on("click", ".konfirmasiHapus-pelaksana", function() {
		id_pelaksana = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPelaksana", function() {
		var id = id_pelaksana;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pelaksana/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPelaksana();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPelaksana", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pelaksana/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pelaksana').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPelaksana", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pelaksana/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-pelaksana').modal('show');
		})
	})

	$('#form-tambah-pelaksana').submit(function(e) {
		var data = $(this).serialize();
		console.log(data);
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pelaksana/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPelaksana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pelaksana").reset();
				$('#tambah-pelaksana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pelaksana', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pelaksana/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPelaksana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pelaksana").reset();
				$('#update-pelaksana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pelaksana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pelaksana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>