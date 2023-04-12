<footer class="footer pt-3  ">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© 2022 PT Inovasi Otomasi Teknologi
				</div>
			</div>
			<div class="col-lg-6">
				<ul class="nav nav-footer justify-content-center justify-content-lg-end">
					<li class="nav-item">
						<a href="https://iotech.co.id" class="nav-link text-muted" target="_blank">About Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
</main>
<!--   Core JS Files   -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/chartjs.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/all.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/argon-dashboard.min.js?v=2.0.1"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkvuKagRiFJGavzz2vXIhRJ4SWbd-A3-Y&libraries=places"></script>
<?php if ($mainpage == 'product_cycle_tracking') : ?>
	<script>
		function initMap() {
			const myLatlng = {
				lat: -6.193739172824711,
				lng: 106.76588773727418
			};

			const map = new google.maps.Map(document.getElementById("googleMap"), {
				zoom: 10,
				center: myLatlng,
				streetViewControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});


			// Create the initial InfoWindow.
			let infoWindow = new google.maps.InfoWindow({
				content: "Click the map to get Lat/Lng!",
				position: myLatlng,
			});

			infoWindow.open(map);
			const input = document.getElementById("pac-input");
			// const options = {
			//     fields: ["formatted_address", "geometry", "name"],
			//     strictBounds: false,
			//     types: ["establishment"],
			// };
			const autocomplete = new google.maps.places.Autocomplete(input);
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				// console.log(place);
				infoWindow.close();
				infoWindow = new google.maps.InfoWindow({
					position: {
						lat: place.geometry.location.lat(),
						lng: place.geometry.location.lng()
					},
				});
				infoWindow.setContent(
					JSON.stringify({
						lat: place.geometry.location.lat(),
						lng: place.geometry.location.lng()
					}, null, 2)

				);
				infoWindow.open(map);
				$("#lattitude").val(place.geometry.location.lat());
				$("#longitude").val(place.geometry.location.lng());
			});

			// Configure the click listener.
			map.addListener("click", (mapsMouseEvent) => {
				// Close the current InfoWindow.
				infoWindow.close();

				// Create a new InfoWindow.
				infoWindow = new google.maps.InfoWindow({
					position: mapsMouseEvent.latLng,
				});
				infoWindow.setContent(
					JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)

				);
				infoWindow.open(map);
				$("#lattitude").val(mapsMouseEvent.latLng.toJSON().lat);
				$("#longitude").val(mapsMouseEvent.latLng.toJSON().lng);
			});

		}
		$(document).ready(
			initMap
		);
	</script>
<?php endif; ?>

<script>
	$(document).ready(function() {
		$('.selectize').selectize({
			sortField: 'text'
		});
	});
</script>
<?php if ($mainpage == 'reporting') : ?>
	<script>
		$(function() {
			$('input[name="datetimerange"]').daterangepicker({
				timePicker: true,
				// startDate: moment().startOf('hour'),
				// endDate: moment().startOf('hour').add(32, 'hour'),

				locale: {
					separator: " to ",
					format: 'YYYY-MM-DD HH:mm:ss'
				}
			});
		});
		// $(document).ready(function() {
		// 	$("#export_form").submit(function(e) {
		// 		e.preventDefault();
		// 		var datetimerange = $("#datetimerange").val();;
		// 		var line_name = $("#line_name").val();
		// 		$.ajax({
		// 			type: "POST",
		// 			url: '<?php echo base_url(); ?>/ajax/export',
		// 			data: JSON.stringify({
		// 				datetimerange: datetimerange,
		// 				line_name: line_name
		// 			}),
		// 			contentType: "application/json; charset=utf-8",
		// 			async: true,
		// 			dataType: 'json',
		// 		}).done(function(data) {
		// 			var $a = $("<a>");
		// 			$a.attr("href", data.file);
		// 			$("body").append($a);
		// 			$a.attr("download", data.file_name);
		// 			$a[0].click();
		// 			$a.remove();
		// 		});
		// 	});
		// });
	</script>
<?php endif; ?>
<?php if ($mainpage == 'oee_management') : ?>
	<script>
		$(document).ready(function() {
			$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
				localStorage.setItem('lastTab', $(this).attr('href'));
			});
			var lastTab = localStorage.getItem('lastTab');
			if (lastTab) {
				$('a[href="' + lastTab + '"]').tab('show');
			}
		});
	</script>
<?php endif; ?>
<?php if ($mainpage == 'dashboard') : ?>
	<script>
		$(document).ready(function() {
			$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
				localStorage.setItem('lastTab', $(this).attr('href'));
			});
			var lastTab = localStorage.getItem('lastTab');
			if (lastTab) {
				$('a[href="' + lastTab + '"]').tab('show');
			}
		});
	</script>
	<script>
		$(document).ready(function() {
			let get_all_data = function() {
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url() . '/ajax/get_line_info'; ?>',
					async: true,
					dataType: 'json',
					success: function(data) {
						for (i = 0; i < data.length; i++) {
							$("#performance_" + data[i].id).html(data[i].performance);
							$("#performance_bar_" + data[i].id).css("width", data[i].performance + "%");
							if (data[i].performance >= 80) {
								$("#performance_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-gradient-danger").addClass("bg-success");
							} else if (data[i].performance < 80 && data[i].performance > 50) {
								$("#performance_bar_" + data[i].id).removeClass("bg-gradient-danger").removeClass("bg-success").addClass("bg-gradient-warning");
							} else if (data[i].performance <= 50) {
								$("#performance_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-success").addClass("bg-gradient-danger");
							}
							$("#availability_" + data[i].id).html(data[i].availability);
							$("#availability_bar_" + data[i].id).css("width", data[i].availability + "%");
							if (data[i].availability >= 80) {
								$("#availability_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-gradient-danger").addClass("bg-success");
							} else if (data[i].availability < 80 && data[i].availability > 50) {
								$("#availability_bar_" + data[i].id).removeClass("bg-gradient-danger").removeClass("bg-success").addClass("bg-gradient-warning");
							} else if (data[i].availability <= 50) {
								$("#availability_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-success").addClass("bg-gradient-danger");
							}
							$("#quality_" + data[i].id).html(data[i].quality);
							$("#quality_bar_" + data[i].id).css("width", data[i].quality + "%");
							if (data[i].quality >= 80) {
								$("#quality_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-gradient-danger").addClass("bg-success");
							} else if (data[i].quality < 80 && data[i].quality > 50) {
								$("#quality_bar_" + data[i].id).removeClass("bg-gradient-danger").removeClass("bg-success").addClass("bg-gradient-warning");
							} else if (data[i].quality <= 50) {
								$("#quality_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-success").addClass("bg-gradient-danger");
							}
							$("#progress_" + data[i].id).html(data[i].progress);
							$("#progress_bar_" + data[i].id).css("width", data[i].progress + "%");
							if (data[i].progress >= 80) {
								$("#progress_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-gradient-danger").addClass("bg-success");
							} else if (data[i].progress < 80 && data[i].progress > 50) {
								$("#progress_bar_" + data[i].id).removeClass("bg-gradient-danger").removeClass("bg-success").addClass("bg-gradient-warning");
							} else if (data[i].progress <= 50) {
								$("#progress_bar_" + data[i].id).removeClass("bg-gradient-warning").removeClass("bg-success").addClass("bg-gradient-danger");
							}
							$("#performance_ov_" + data[i].id).gaugeMeter({
								percent: data[i].performance,
								text: parseInt(data[i].performance).toFixed(1)
							});
							$("#availability_ov_" + data[i].id).gaugeMeter({
								percent: data[i].availability,
								text: parseInt(data[i].availability).toFixed(1)
							});
							$("#quality_ov_" + data[i].id).gaugeMeter({
								percent: data[i].quality,
								text: parseInt(data[i].quality).toFixed(1)
							});
							$("#progress_ov_" + data[i].id).gaugeMeter({
								percent: data[i].progress,
								text: parseInt(data[i].progress).toFixed(1)
							});
							$("#sku_" + data[i].id).html(data[i].sku_code);
							$("#setup_time_" + data[i].id).html(data[i].setup_time);
							$("#cycle_time_" + data[i].id).html(data[i].cycle_time);
							$("#run_time_" + data[i].id).html(data[i].run_time);
							$("#down_time_" + data[i].id).html(data[i].down_time);
							$("#item_counter_" + data[i].id).html(data[i].item_counter);
							$("#NG_" + data[i].id).html(data[i].NG_count);
							// $("#ng_count_form_" + data[i].id).val(data[i].NG_count);
							$("#status_" + data[i].id).html(data[i].status);
							$("#order_id_" + data[i].id).html(data[i].order_id);
							$("#target_" + data[i].id).html(data[i].target);
						}
					}
				});
				$.ajax({
					type: 'GET',
					url: '<?php echo base_url() . '/ajax/get_avg_info'; ?>',
					async: true,
					dataType: 'json',
					success: function(data) {
						$("#avg_oee").gaugeMeter({
							percent: data.avg_oee,
							text: data.avg_oee.toFixed(1)
						});
						$("#avg_performance").gaugeMeter({
							percent: data.avg_performance,
							text: data.avg_performance.toFixed(1)
						});
						$("#avg_availability").gaugeMeter({
							percent: data.avg_availability,
							text: data.avg_availability.toFixed(1)
						});
						$("#avg_quality").gaugeMeter({
							percent: data.avg_quality,
							text: data.avg_quality.toFixed(1)
						});
					}
				});
			}
			get_all_data();
			setInterval(get_all_data, 1000);
		});
		let plus_ng = function(id) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . '/ajax/plus_ng'; ?>',
				data: JSON.stringify({
					id: id
				}),
				contentType: "application/json; charset=utf-8",
				async: true,
				dataType: 'json',
				success: function(data) {
					$("#NG_" + id).html(data.ng);
					$("#ng_count_form_" + id).val(data.ng);
					// console.log(data);
				}
			});
		}
		let minus_ng = function(id) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . '/ajax/minus_ng'; ?>',
				data: JSON.stringify({
					id: id
				}),
				contentType: "application/json; charset=utf-8",
				async: true,
				dataType: 'json',
				success: function(data) {
					$("#NG_" + id).html(data.ng);
					$("#ng_count_form_" + id).val(data.ng);
				}
			});
		}
		let double_plus_ng = function(id) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . '/ajax/double_plus_ng'; ?>',
				data: JSON.stringify({
					id: id
				}),
				contentType: "application/json; charset=utf-8",
				async: true,
				dataType: 'json',
				success: function(data) {
					$("#NG_" + id).html(data.ng);
					$("#ng_count_form_" + id).val(data.ng);
				}
			});
		}
		let double_minus_ng = function(id) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() . '/ajax/double_minus_ng'; ?>',
				data: JSON.stringify({
					id: id
				}),
				contentType: "application/json; charset=utf-8",
				async: true,
				dataType: 'json',
				success: function(data) {
					$("#NG_" + id).html(data.ng);
					$("#ng_count_form_" + id).val(data.ng);
				}
			});
		}
	</script>
<?php endif; ?>
<script>
	$(document).ready(function() {
		$('#sku_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/sku_list') ?>",
				"type": "POST"
			},
		});
		$('#log_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/log_list') ?>",
				"type": "POST"
			},
			"aaSorting": [
				[0, "desc"]
			]
		});
		$('#pic_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/pic_list') ?>",
				"type": "POST"
			},
		});
		$('#remark_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/remark_list') ?>",
				"type": "POST"
			},
		});
		$('#order_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/order_list') ?>",
				"type": "POST"
			},
			"aaSorting": [
				[0, "desc"]
			]
		});
		$('#inventory_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/inventory_list') ?>",
				"type": "POST"
			},
		});
		$('#finished_goods_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/finished_goods_list') ?>",
				"type": "POST"
			},
		});
		$('#tracking_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/tracking_list') ?>",
				"type": "POST"
			},
			"aaSorting": [
				[0, "desc"]
			]
		});
		$('#event_log').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/event_list') ?>",
				"type": "POST"
			},
			"aaSorting": [
				[0, "desc"]
			]
		});
		$('#account_list').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"ajax": {
				"url": "<?php echo base_url('ajax/account_list') ?>",
				"type": "POST"
			},
			// "aaSorting": [
			//     [0, "desc"]
			// ]
		});
	});
	$(document).ready(function() {
		var span = document.getElementById('clock');

		function time() {
			var d = new Date();
			var s = d.getSeconds();
			var m = d.getMinutes();
			var h = d.getHours();
			span.textContent =
				("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
		}
		setInterval(time, 1000);
	});
</script>
<script src="<?php echo base_url(); ?>assets/js/GaugeMeter.js"></script>
<script>
	$(document).ready(function() {
		$(".GaugeMeter").gaugeMeter();
	});
</script>
<style>
	.GaugeMeter {
		Position: Relative;
		Text-Align: Center;
		Overflow: Hidden;
		Cursor: Default;
	}

	.GaugeMeter SPAN,
	.GaugeMeter B {
		Margin: 0 23%;
		Width: 54%;
		Position: Absolute;
		Text-align: Center;
		Display: Inline-Block;
		Color: RGBa(0, 0, 0, .8);
		Font-Weight: 100;
		Font-Family: "Open Sans", Arial;
		Overflow: Hidden;
		White-Space: NoWrap;
		Text-Overflow: Ellipsis;
	}

	.GaugeMeter[data-style="Semi"] B {
		Margin: 0 10%;
		Width: 80%;
	}

	.GaugeMeter S,
	.GaugeMeter U {
		Text-Decoration: None;
		Font-Size: .5em;
		Opacity: .5;
	}

	.GaugeMeter B {
		Color: Black;
		Font-Weight: 300;
		Font-Size: .5em;
		Opacity: .8;
	}
</style>


</body>

</html>