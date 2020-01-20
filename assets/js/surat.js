tinyMCE.init({
	selector: '#surat_dinas'
});
tinyMCE.init({
	selector: '#nota_dinas'
});
$(function () {
	$('#dari').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#sampai').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#waktu').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#start').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#end').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#keberangkatan').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#kepulangan').bootstrapMaterialDatePicker({
		weekStart: 0,
		time: false,
		format: 'MM/DD/YYYY'
	});
	$('#waktu_kegiatan').bootstrapMaterialDatePicker({
		date: false,
		format: 'HH.mm'
	});

});
var base_url_surat = $('#url').val();
$('.preview').on('click', function () {
	let id = $(this).data('id');
	$.ajax({
		url: base_url_surat + "Surat/getSuratMasuk",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			$('.info_no_surat').html(data.surat_masuk[0].nomor_surat);
			$('.info_waktu_surat_masuk').html(data.surat_masuk[0].tanggal);
			$('.info_asal_surat').html(data.surat_masuk[0].asal_surat);
			$('.info_perihal').html(data.surat_masuk[0].perihal);
			$('.info_jumlah_dokumen').html(data.dokumen);
			$('.info_tempat').html(data.surat_masuk[0].tempat);
			if (data.surat_masuk[0].mulai_kegiatan < data.surat_masuk[0].akhir_kegiatan) {
				$('.info_pelaksanaan').html(data.surat_masuk[0].mulai_kegiatan + " - " + data.surat_masuk[0].akhir_kegiatan);
			} else {
				$('.info_pelaksanaan').html(data.surat_masuk[0].mulai_kegiatan);
			}
			let i;
			let element = "";
			for (i = 0; i < data.penerima.length; i++) {
				element = element + data.penerima[i].nama + "<br>";
			}
			if (element != "") {
				$('.daftar_penerima_disposisi').html('<h6 class="font-weight-bold" style="font-size: 14px; color: #000; ">Disposisi </h6>' + '<p style="line-height: 25px;">' + element + '</p>');
			} else {
				$('.daftar_penerima_disposisi').html(element);
			}
		},
		error: function () {
			console.log("failed data request");
		}
	});
});
var nip = 0;
$(document).ready(function () {
	$.ajax({
		url: base_url_surat + "Surat/tampilkanPenerimaDisposisi",
		data: {
			id: null
		},
		method: 'post',
		success: function (data) {
			$('#tbl_result').html(data);
		}
	});
	$('.disposisiSurat').on('click', function () {
		let id = $(this).data('id');
		let element = "";
		$('.info_no_surat').html("");
		$('.info_waktu_surat_masuk').html("");
		$('.info_asal_surat').html("");
		$('.info_perihal').html("");
		$('.info_jumlah_dokumen').html("");
		$('.info_tempat').html("");
		$('.info_pelaksanaan').html("");
		$('.arahan_').val("");
		$('.sifat_').val("sangat segera");
		$('.catatan_').val("");
		$('.daftar_penerima_disposisi').html(element);
		$('#tanggapan').prop('checked', false);
		$('#lanjutkan').prop('checked', false);
		$('#koordinasikan').prop('checked', false);
		$.ajax({
			url: base_url_surat + "Surat/getSuratMasuk",
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('.info_no_surat').html(data.surat_masuk[0].nomor_surat);
				$('.info_waktu_surat_masuk').html(data.surat_masuk[0].tanggal);
				$('.info_asal_surat').html(data.surat_masuk[0].asal_surat);
				$('.info_perihal').html(data.surat_masuk[0].perihal);
				$('.info_tempat').html(data.surat_masuk[0].tempat);
				$('.info_pelaksanaan').html(data.surat_masuk[0].mulai_kegiatan);
				$('.info_jumlah_dokumen').html(data.dokumen);
				if (data.surat_masuk[0].status == 2) {
					$('.id_surat_').val(data.disposisi[0].id);
					$('.arahan_').val(data.disposisi[0].arahan);
					$('.sifat_').val(data.disposisi[0].sifat);
					$('.catatan_').val(data.disposisi[0].catatan);
					if (data.disposisi[0].harapan == '100') {
						$('#tanggapan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '010') {
						$('#lanjutkan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '001') {
						$('#koordinasikan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '110') {
						$('#tanggapan').prop('checked', true);
						$('#lanjutkan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '101') {
						$('#tanggapan').prop('checked', true);
						$('#koordinasikan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '011') {
						$('#lanjutkan').prop('checked', true);
						$('#koordinasikan').prop('checked', true);
					} else if (data.disposisi[0].harapan == '111') {
						$('#tanggapan').prop('checked', true);
						$('#lanjutkan').prop('checked', true);
						$('#koordinasikan').prop('checked', true);
					} else {
						$('#tanggapan').prop('checked', false);
						$('#lanjutkan').prop('checked', false);
						$('#koordinasikan').prop('checked', false);
					}
				} else {
					console.log('belum disposisi');
				}
				let no_surat = data.surat_masuk[0].nomor_surat;
				$.ajax({
					url: base_url_surat + "Surat/getListPenerimaDisposisi",
					data: {
						id: id
					},
					method: 'post',
					success: function (data) {
						$('.daftar_penerima_disposisi').html(data);
						$('.deletePenerimaDisposisi').on('click', function () {
							let nip = $(this).data('id');
							$.ajax({
								url: base_url_surat + "Surat/deletePenerimaDisposisi",
								data: {
									nip: nip,
									no_surat: no_surat
								},
								method: 'post',
								success: function (data) {
									$('.daftar_penerima_disposisi').html(data);
								},
								error: function () {
									console.log("failed data request");
								}
							});
						});
					},
					error: function () {
						console.log("failed data request");
					}
				});
			},
			error: function () {
				console.log("failed data request");
			}
		});
	});
});
$(function () {
	$('#cariPNS').keyup(function () {
		const cariPNS = $(this).val();
		let no_surat = $('.get_info_no_surat').text();
		if (cariPNS != '') {
			$.ajax({
				url: base_url_surat + "Surat/cariPNS",
				data: {
					id: cariPNS,
					nomor_surat: no_surat
				},
				method: 'post',
				success: function (data_pencarian) {
					$('#result').html(data_pencarian);
					$('.saveOnDisposisi').on('click', function () {
						const id = $(this).data('id');
						nip = id;
						$.ajax({
							url: base_url_surat + "Surat/tambahPenerimaDisposisi",
							data: {
								id: nip
							},
							method: 'post',
							success: function (data) {
								if (data != 0) {
									$.ajax({
										url: base_url_surat + "Surat/tampilkanPenerimaDisposisi",
										data: {
											id: null
										},
										method: 'post',
										success: function (data) {
											$('#tbl_result').html(data);
										}
									});
								} else {
									$('#tbl_result').html("");
								}
							}
						});
					});
				}
			});
		} else {
			$('#result').html('');
		}
	});
});
$(function () {
	$('#cariPNSSuratKeluar').keyup(function () {
		const cariPNS = $(this).val();
		let no_surat = $('.get_info_no_surat').text();
		if (cariPNS != '') {
			$.ajax({
				url: base_url_surat + "Surat/cariPNSSuratKeluar",
				data: {
					id: cariPNS,
					nomor_surat: no_surat
				},
				method: 'post',
				success: function (data_pencarian) {
					$('#result').html(data_pencarian);
					$('.saveOnDisposisi').on('click', function () {
						const id = $(this).data('id');
						nip = id;
						$.ajax({
							url: base_url_surat + "Surat/tambahPenerimaDisposisi",
							data: {
								id: nip
							},
							method: 'post',
							success: function (data) {
								if (data != 0) {
									$.ajax({
										url: base_url_surat + "Surat/tampilkanPenerimaDisposisi",
										data: {
											id: null
										},
										method: 'post',
										success: function (data) {
											$('#tbl_result').html(data);
										}
									});
								} else {
									$('#tbl_result').html("");
								}
							}
						});
					});
				}
			});
		} else {
			$('#result').html('');
		}
	});
});
$(function () {
	$('.resetDisposisi').on('click', function () {
		$.ajax({
			url: base_url_surat + "Surat/clearUserDataDisposisi",
			data: {
				id: 'kosong'
			},
			method: 'post',
			success: function () {
				$.ajax({
					url: base_url_surat + "Surat/tampilkanPenerimaDisposisi",
					data: {
						id: null
					},
					method: 'post',
					success: function () {
						$('#tbl_result').html("");
						$('.deleteData').on('click', function () {
							console.log('delete data');
						});
					}
				});
			},
			error: function () {
				console.log('Data Not Found');
			}
		});
	});
});
$('.sendDisposisi').on('click', function () {
	let arahan = [];
	let sifat = [];
	let ikutsertakegiatan = 0;
	$.each($('.arahan_ option:selected'), function () {
		arahan.push($(this).val());
	});
	$.each($('.sifat_ option:selected'), function () {
		sifat.push($(this).val());
	});
	let nomor_surat = $('.get_info_no_surat').text();
	let id_surat = $('.id_surat_').val();
	let tanggapan, lanjutkan, koordinasikan;
	if ($('#tanggapan').is(":checked")) {
		tanggapan = $('#tanggapan').val();
	} else {
		tanggapan = 0;
	}
	if ($('#lanjutkan').is(":checked")) {
		lanjutkan = $('#lanjutkan').val();
	} else {
		lanjutkan = 0;
	}
	if ($('#koordinasikan').is(":checked")) {
		koordinasikan = $('#koordinasikan').val();
	} else {
		koordinasikan = 0;
	}
	if ($('#ikutsertakegiatan').is(":checked")) {
		ikutsertakegiatan = 1
	}
	let timerInterval
	Swal.fire({
		title: 'Status!',
		html: 'Penyimpanan data sedang dilakukan!.',
		timer: 2000,
		onBeforeOpen: () => {
			Swal.showLoading()
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
	}).then((result) => {
		$.ajax({
			url: base_url_surat +
				"Surat/createSuratDisposisi",
			data: {
				sifat: sifat.toString(),
				catatan: $('.catatan_').val(),
				id: id_surat,
				harapan_1: tanggapan,
				harapan_2: lanjutkan,
				harapan_3: koordinasikan,
				nomor_surat: nomor_surat,
				ikutundangan: ikutsertakegiatan
			},
			method: 'post',
			success: function () {
				Swal.fire({
					type: 'success',
					title: 'Surat Telah Berhasil Didisposisikan!',
					showConfirmButton: true
				}).then((result) => {
					location.reload();
				});
			},
			error: function () {
				Swal.fire({
					type: 'error',
					title: 'Surat Tidak Berhasil Didisposisikan!',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	})
});
$('.notaDinas').on('click', function () {
	let id = $(this).data('id');
	$.ajax({
		url: base_url + "Surat/getSuratDisposisi",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			$('.pendisposisi').html(data.surat[0].nama);
			$('.perihal').html(data.surat[0].perihal);
			$('.agenda').val(data.surat[0].nomor_agenda);
		},
		error: function () {
			console.log('Data Not Found');
		}
	});
	$.ajax({
		url: base_url + "Surat/NotaDinas/getBidang",
		data: {
			id: id
		},
		method: 'post',
		success: function (data) {
			$('.tembusan').html(data);
		},
		error: function () {
			console.log('Data Not Found');
		}
	});
});
$('.tracking').on('click', function () {
	let id = $(this).data('id');
	$('#tbl_tracking').html("");
	$.ajax({
		url: base_url_surat + "Surat/trackingSuratMasuk",
		data: {
			id: id
		},
		method: 'post',
		success: function (data) {
			$('#tbl_tracking').html(data);
		},
		error: function () {
			console.log('Data Not Found');
		}
	});
});

$('.hapussuratmasuk').on('click', function () {
	let slug_surat = $(this).data('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: base_url_surat +
					"Surat/deletesuratmasuk/",
				data: {
					slug: slug_surat
				},
				method: 'post',
				success: function () {
					Swal.fire({
						type: 'success',
						title: 'Surat Telah Berhasil dihapus!',
						showConfirmButton: true
					}).then((result) => {
						location.reload();
					});
				},
				error: function () {
					Swal.fire({
						type: 'error',
						title: 'Surat Tidak Berhasil dihapus!',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});
		} else {
			result.dismiss === Swal.DismissReason.cancel
		}
	});
});

$('.sendTerusanSuratMasuk').on('click', function(){
	let pnm = $('#penerima_surat').val();
	let ns = $('#no_surat').text();
	let timerInterval
	Swal.fire({
		title: 'Status!',
		html: 'Surat Sedang Diteruskan Ke Penerima!.',
		timer: 2000,
		onBeforeOpen: () => {
			Swal.showLoading()
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
	}).then((result) => {
		$.ajax({
			url: base_url_surat +
				"Surat/forwardSuratMasuk",
			data: {
				no: ns,
				penerima: pnm
			},
			method: 'post',
			success: function () {
				Swal.fire({
					type: 'success',
					title: 'Surat Telah Berhasil Diteruskan!',
					showConfirmButton: true
				}).then((result) => {
					location.reload();
				});
			},
			error: function () {
				Swal.fire({
					type: 'error',
					title: 'Surat Tidak Berhasil Diteruskan!',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	});
});

$('.lihatDetailSuratKeluar').on('click', function(){
	let nomor_surat = $(this).data('id');
	$('.info_no_surat').html("");
	$('.info_waktu_surat_masuk').html("");
	$('.info_asal_surat').html("");
	$('.info_perihal').html("");
	$('.info_tempat').html("");
	$('.info_pelaksanaan').html("");
	$('.penerima_surat').html("");
	$.ajax({
		url: base_url_surat + "Surat/getInfoSuratKeluar",
		data: {
			nomor_surat: nomor_surat
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			$('.info_no_surat').html(data.surat_keluar[0].nomor_surat_keluar);
			$('.info_waktu_surat_masuk').html(data.surat_keluar[0].tanggal);
			$('.info_asal_surat').html(data.surat_keluar[0].asal_surat);
			$('.info_perihal').html(data.surat_keluar[0].perihal);
			$('.info_tempat').html(data.surat_keluar[0].tempat);
			$('.info_pelaksanaan').html(data.surat_keluar[0].mulai_kegiatan);
			$.each(data.penerima_surat, function (index, element) {
				$('.penerima_surat').append($('<div>', {
					text: element.nama_instansi + ", "
				}));
			});
		},
		error: function () {
			console.log("failed data request");
		}
	});
});