window.onload = () => {
	tampilPelanggan();
	tampilPelaksana();
	tampilJasa();
}

const toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true
});

let dataTable = $('#list-data').dataTable({
	'paging': true,
	'lengthChange': true,
	'searching': true,
	'ordering': true,
	'info': true,
	'autoWidth': false
});

const refresh = () => {
	dataTable = $('#list-data').dataTable();
}

const showNotification = (type = 'error', message = null) => {
	toast.fire({
		icon: type,
		html: message
	});
}

const showError = () => {
	toast.fire({
		icon: 'error',
		text: 'Terjadi kesalahan saat memproses permintaan Anda'
	});
}

//pelanggan
const tampilPelanggan = () => {
	$.get(BASE_URL + 'pelanggan/tampil', (data) => {
		dataTable.fnDestroy();
		$('#data-pelanggan').html(data);
		refresh();
	});
}

let idPelanggan;

$(document).on('click', '.konfirmasiHapus-pelanggan', function () {
	idPelanggan = $(this).attr('data-id');
})

$(document).on('click', '.hapus-dataPelanggan', function () {
	const id = idPelanggan;

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelanggan/delete',
		data: {
			id: id
		},
		success: (response) => {
			$('#konfirmasiHapus').modal('hide');
			showNotification(response.type, response.message);
			tampilPelanggan();
		},
		error: () => {
			showError();
		}
	});
})

$(document).on('click', '.update-dataPelanggan', function () {
	const id = $(this).attr('data-id');

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelanggan/update',
		data: {
			id: id
		},
		success: (response) => {
			$('#tempat-modal').html(response);
			$('#update-pelanggan').modal('show');
		},
		error: () => {
			showError();
		}
	})
})

$('#form-tambah-pelanggan').submit(function (e) {
	e.preventDefault();
	const data = $(this).serialize();
	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelanggan/prosesTambah',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-tambah-pelanggan').trigger('reset');
				$('#tambah-pelanggan').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilPelanggan();
		},
		error: () => {
			showError();
		}
	});
});

$(document).on('submit', '#form-update-pelanggan', function (e) {
	e.preventDefault();
	const data = $(this).serialize();

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelanggan/prosesUpdate',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-update-pelanggan').trigger('reset');
				$('#update-pelanggan').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilPelanggan();
		},
		error: () => {
			showError();
		}
	})
});

//Jasa
const tampilJasa = () => {
	$.get(BASE_URL + 'jasa/tampil', (data) => {
		dataTable.fnDestroy();
		$('#data-jasa').html(data);
		refresh();
	});
}

let idJasa;

$(document).on('click', '.konfirmasiHapus-jasa', function () {
	idJasa = $(this).attr('data-id');
})

$(document).on('click', '.hapus-dataJasa', function () {
	const id = idJasa;

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'jasa/delete',
		data: {
			id: id
		},
		success: (response) => {
			$('#konfirmasiHapus').modal('hide');
			showNotification(response.type, response.message);
			tampilJasa();
		},
		error: () => {
			showError();
		}
	});
})

$(document).on('click', '.update-dataJasa', function () {
	const id = $(this).attr('data-id');

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'jasa/update',
		data: {
			id: id
		},
		success: (response) => {
			$('#tempat-modal').html(response);
			$('#update-jasa').modal('show');
		},
		error: () => {
			showError();
		}
	});
})

$(document).on('click', '.detail-dataJasa', function () {
	const id = $(this).attr('data-id');

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'jasa/detail',
		data: {
			id: id
		},
		success: (response) => {
			$('#tempat-modal').html(response);
			$('#tabel-detail').dataTable({
				'paging': true,
				'lengthChange': false,
				'searching': true,
				'ordering': true,
				'info': true,
				'autoWidth': false
			});
			$('#detail-jasa').modal('show');
		},
		error: () => {
			showError();
		}
	});
})

$('#form-tambah-jasa').submit(function (e) {
	e.preventDefault();
	const data = $(this).serialize();
	
	$.ajax({
		method: 'POST',
		url: BASE_URL + 'jasa/prosesTambah',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-tambah-jasa').trigger('reset');
				$('#tambah-jasa').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilJasa();
		},
		error: () => {
			showError();
		}
	});
});

$(document).on('submit', '#form-update-jasa', function (e) {
	e.preventDefault();
	const data = $(this).serialize();

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'jasa/prosesUpdate',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-update-jasa').trigger('reset');
				$('#update-jasa').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilJasa();
		},
		error: () => {
			showError();
		}
	});
});

//pelaksana
const tampilPelaksana = () => {
	$.get(BASE_URL + 'pelaksana/tampil', (data) => {
		dataTable.fnDestroy();
		$('#data-pelaksana').html(data);
		refresh();
	});
}

let idPelaksana;

$(document).on('click', '.konfirmasiHapus-pelaksana', function () {
	idPelaksana = $(this).attr('data-id');
})

$(document).on('click', '.hapus-dataPelaksana', function () {
	const id = idPelaksana;

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelaksana/delete',
		data: {
			id: id
		},
		success: (response) => {
			$('#konfirmasiHapus').modal('hide');
			showNotification(response.type, response.message);
			tampilPelaksana();
		},
		error: () => {
			showError();
		}
	});
})

$(document).on('click', '.update-dataPelaksana', function () {
	const id = $(this).attr('data-id');

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelaksana/update',
		data: {
			id: id
		},
		success: (response) => {
			$('#tempat-modal').html(response);
			$('#update-pelaksana').modal('show');
		},
		error: () => {
			showError();
		}
	});
})

$(document).on('click', '.detail-dataPelaksana', function () {
	const id = $(this).attr('data-id');

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelaksana/detail',
		data: {
			id: id
		},
		success: (response) => {
			$('#tempat-modal').html(response);
			$('#tabel-detail').dataTable({
				'paging': true,
				'lengthChange': false,
				'searching': true,
				'ordering': true,
				'info': true,
				'autoWidth': false
			});
			$('#detail-pelaksana').modal('show');
		},
		error: () => {
			showError();
		}
	});
})

$('#form-tambah-pelaksana').submit(function (e) {
	e.preventDefault();
	const data = $(this).serialize();
	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelaksana/prosesTambah',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-tambah-pelaksana').trigger('reset');
				$('#tambah-pelaksana').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilPelaksana();
		},
		error: () => {
			showError();
		}
	});
});

$(document).on('submit', '#form-update-pelaksana', function (e) {
	e.preventDefault();
	const data = $(this).serialize();

	$.ajax({
		method: 'POST',
		url: BASE_URL + 'pelaksana/prosesUpdate',
		data: data,
		success: (response) => {
			if (response.type !== 'warning') {
				$('#form-update-pelaksana').trigger('reset');
				$('#update-pelaksana').modal('hide');
			}
			showNotification(response.type, response.message);
			tampilPelaksana();
		},
		error: () => {
			showError();
		}
	});
});