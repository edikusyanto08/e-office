"use strict";
! function (e) {
	e(document).ready(function () {
		var base_url_statistik = $('#base_url_statistik').val();
		e("#blog-overview-date-range").datepicker({});
		[{
			backgroundColor: "rgba(0, 184, 216, 0.1)",
			borderColor: "rgb(0, 184, 216)",
			data: [1, 2, 1, 3, 5, 4, 7]
		}, {
			backgroundColor: "rgba(23,198,113,0.1)",
			borderColor: "rgb(23,198,113)",
			data: [1, 2, 3, 3, 3, 4, 4]
		}, {
			backgroundColor: "rgba(255,180,0,0.1)",
			borderColor: "rgb(255,180,0)",
			data: [2, 3, 3, 3, 4, 3, 3]
		}, {
			backgroundColor: "rgba(255,65,105,0.1)",
			borderColor: "rgb(255,65,105)",
			data: [1, 7, 1, 3, 1, 4, 8]
		}, {
			backgroundColor: "rgb(0,123,255,0.1)",
			borderColor: "rgb(0,123,255)",
			data: [3, 2, 3, 2, 4, 5, 4]
		}].map(function (e, o) {
			var a = {
					maintainAspectRatio: !0,
					responsive: !0,
					legend: {
						display: !1
					},
					tooltips: {
						enabled: !1,
						custom: !1
					},
					elements: {
						point: {
							radius: 0
						},
						line: {
							tension: .3
						}
					},
					scales: {
						xAxes: [{
							gridLines: !1,
							scaleLabel: !1,
							ticks: {
								display: !1
							}
						}],
						yAxes: [{
							gridLines: !1,
							scaleLabel: !1,
							ticks: {
								display: !1,
								suggestedMax: Math.max.apply(Math, e.data) + 1
							}
						}]
					}
				},
				r = document.getElementsByClassName("blog-overview-stats-small-" + (o + 1));
			new Chart(r, {
				type: "line",
				data: {
					labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7"],
					datasets: [{
						label: "Today",
						fill: "start",
						data: e.data,
						backgroundColor: e.backgroundColor,
						borderColor: e.borderColor,
						borderWidth: 1.5
					}]
				},
				options: a
			})
		});
		// statistik surat masuk
		$.ajax({
			url: base_url_statistik + "Surat/getStatistikSuratMasuk",
			data: {
				id: null
			},
			method: 'post',
			datatType: 'json',
			success: function (data) {
				var obj = JSON.parse(data);
				var o = document.getElementsByClassName("surat-masuk-statistik")[0],
					a = {
						labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Augstus", "September", "Oktober", "November", "Desember"],
						datasets: [{
							label: "Data ",
							fill: "start",
							data: [obj.januari, obj.februari, obj.maret, obj.april, obj.mei, obj.juni, obj.juli, obj.agustus, obj.september, obj.oktober, obj.november, obj.desember],
							backgroundColor: "rgba(0,123,255,0.1)",
							borderColor: "rgba(0,123,255,1)",
							pointBackgroundColor: "#ffffff",
							pointHoverBackgroundColor: "rgb(0,123,255)",
							borderWidth: 2,
							pointRadius: 0,
							pointHoverRadius: 3
						}]
					};
				window.BlogOverviewUsers = new Chart(o, {
					type: "LineWithLine",
					data: a,
					options: {
						responsive: !0,
						legend: {
							position: "top"
						},
						hover: {
							mode: "nearest",
							intersect: !1
						},
						tooltips: {
							custom: !1,
							mode: "nearest",
							intersect: !1
						}
					}
				});
				var r = BlogOverviewUsers.getDatasetMeta(0);
				r.data[0]._model.radius = 0, r.data[a.datasets[0].data.length - 1]._model.radius = 0, window.BlogOverviewUsers.render();
			}
		});

		$.ajax({
			url: base_url_statistik + "Surat/getStatistikSuratKeluar",
			data: {
				id: null
			},
			method: 'post',
			datatType: 'json',
			success: function (data) {
				var obj = JSON.parse(data);
				var o = document.getElementsByClassName("surat-keluar-statistik")[0],
					a = {
						labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Augstus", "September", "Oktober", "November", "Desember"],
						datasets: [{
							label: "Data ",
							fill: "start",
							data: [obj.januari, obj.februari, obj.maret, obj.april, obj.mei, obj.juni, obj.juli, obj.agustus, obj.september, obj.oktober, obj.november, obj.desember],
							backgroundColor: "rgba(0,123,255,0.1)",
							borderColor: "rgba(0,123,255,1)",
							pointBackgroundColor: "#ffffff",
							pointHoverBackgroundColor: "rgb(0,123,255)",
							borderWidth: 2,
							pointRadius: 0,
							pointHoverRadius: 3
						}]
					};
				window.BlogOverviewUsers = new Chart(o, {
					type: "LineWithLine",
					data: a,
					options: {
						responsive: !0,
						legend: {
							position: "top"
						},
						hover: {
							mode: "nearest",
							intersect: !1
						},
						tooltips: {
							custom: !1,
							mode: "nearest",
							intersect: !1
						}
					}
				});
				var r = BlogOverviewUsers.getDatasetMeta(0);
				r.data[0]._model.radius = 0, r.data[a.datasets[0].data.length - 1]._model.radius = 0, window.BlogOverviewUsers.render();
			}
		});

		var t = document.getElementsByClassName("blog-users-by-device")[0];
		window.ubdChart = new Chart(t, {
			type: "pie",
			data: {
				datasets: [{
					hoverBorderColor: "#ffffff",
					data: [68.3, 24.2, 7.5],
					backgroundColor: ["rgba(0,123,255,0.9)", "rgba(0,123,255,0.5)", "rgba(0,123,255,0.3)"]
				}],
				labels: ["Desktop", "Tablet", "Mobile"]
			},
			options: {
				legend: {
					position: "bottom",
					labels: {
						padding: 25,
						boxWidth: 20
					}
				},
				cutoutPercentage: 0,
				tooltips: {
					custom: !1,
					mode: "index",
					position: "nearest"
				}
			}
		})
	})
}(jQuery);
