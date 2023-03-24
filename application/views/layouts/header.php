<!--
=========================================================
* Argon Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
function in_array_any($needles, $haystack)
{
	return !empty(array_intersect($needles, $haystack));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/iot/favicon.png">
	<title>
		Manufacturing Execution System
	</title>
	<!--     Fonts and icons     -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
	<!-- Nucleo Icons -->
	<link href="<?php echo base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/js/kitfontawesome.js" crossorigin="anonymous"></script>
	<!-- Font Awesome Icons -->
	<script src="<?php echo base_url(); ?>assets/js/all.js" crossorigin="anonymous"></script>
	<!-- <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" /> -->
	<link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" />

	<!-- CSS Files -->
	<link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.1" rel="stylesheet" defer />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
	<style>
		@font-face {
			font-family: 'open-sans';
			src: url('<?php echo base_url(); ?>assets/fonts/OpenSans/OpenSans-SemiBold.ttf');
		}

		.pac-container {
			z-index: 99999;
		}
	</style>
</head>

<body class="g-sidenav-show   bg-gray-100">
	<div class="min-height-300 bg-primary position-absolute w-100"></div>
	<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
		<div class="sidenav-header">
			<!-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> -->
			<a class="navbar-brand m-0 text-center" href="https://www.iotech.co.id/" target="_blank">
				<img src="<?php echo base_url(); ?>assets/img/iot/iot_croped.png" class="navbar-brand-img h-100" alt="main_logo">
				<div class="font-weight-bold text-wrap"> Manufacturing Execution System</div>
			</a>
		</div>
		<hr class="horizontal dark mt-4">
		<div class="navbar-collapse  w-auto " id="sidenav-collapse-main">
			<ul class="navbar-nav">
				<?php if (in_array_any(['admin', 'view_dashboard'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'dashboard') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/dashboard">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-tachometer-alt text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Dashboard</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_order'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'order') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/order">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-bookmark text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Order</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_oee_management'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'oee_management') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/oee_management">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-boxes text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">OEE Management</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_warehouse_management'], $privileges)) : ?>
					<!-- <li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'warehouse_management') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/warehouse_management">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-warehouse text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Warehouse Management</span>
						</a>
					</li> -->
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_pct'], $privileges)) : ?>
					<!-- <li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'product_cycle_tracking') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/product_cycle_tracking">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-truck text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Product Cycle Tracking</span>
						</a>
					</li> -->
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_breakdown_log'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'breakdown_log') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/breakdown_log">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-exclamation text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Breakdown Log</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_event_log'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'event_log') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/event_log">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-bell text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Event Log</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin', 'view_reporting'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'reporting') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/reporting">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-file-excel text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Reporting</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if (in_array_any(['admin'], $privileges)) : ?>
					<li class="nav-item">
						<a class="nav-link <?php if ($mainpage == 'admin_panel') : ?>active<?php endif; ?>" href="<?php echo base_url(); ?>pages/admin_panel">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fas fa-user-cog text-primary text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Admin Panel</span>
						</a>
					</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url(); ?>pages/logout">
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="fas fa-sign-out-alt text-primary text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Log Out</span>
					</a>
				</li>
			</ul>

		</div>
		<div class="sidenav-footer mx-3 ">
			<div class="card card-plain shadow-none" id="sidenavCard">
				<img class="w-50 mx-auto" src="../assets/img/iot/mascotPNG2.png" alt="sidebar_illustration">
				<div class="card-body text-center p-3 w-100 pt-0">
					<div class="docs-info">
						<h6 class="mb-0">Need help?</h6>
						<p class="text-xs font-weight-bold mb-0">Contact marketing@iotech.co.id</p>
					</div>
					<div class="docs-info">
						<h6 class="mb-0" id="clock"></h6>
					</div>
				</div>
			</div>
		</div>
	</aside>

	<main class="main-content position-relative border-radius-lg ">
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
						<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">OEE</a></li>
						<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?php echo ucwords($mainpage); ?></li>
					</ol>
				</nav>
				<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

					<ul class="ms-md-auto pe-md-3 navbar-nav justify-content-end">
						<li class="nav-item d-flex align-items-center">
							<a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
								<i class="fa fa-user me-sm-1"></i>
								<span class="d-sm-inline d-none"><?php echo $this->session->userdata('username'); ?></span>
							</a>
						</li>
						<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
							<a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
								<div class="sidenav-toggler-inner">
									<i class="sidenav-toggler-line bg-white"></i>
									<i class="sidenav-toggler-line bg-white"></i>
									<i class="sidenav-toggler-line bg-white"></i>
								</div>
							</a>
						</li>

					</ul>
					<?php if ($this->session->flashdata("success")) : ?>
						<div class="alert alert-success alert-dismissible fade show end-0 top-10" style='z-index:99; position:absolute;' role="alert">
							<strong class="text-white"><?php echo $this->session->flashdata("success"); ?></strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata("failed")) : ?>
						<div class="alert alert-danger alert-dismissible fade show end-0 top-10" style='z-index:99; position:absolute;' role="alert">
							<strong class="text-white"><?php echo $this->session->flashdata("failed"); ?></strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<div class="container-fluid py-4">