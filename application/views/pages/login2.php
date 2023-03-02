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
    <!-- Font Awesome Icons -->
    <script src="<?php echo base_url(); ?>assets/js/all.js" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=2.0.1" rel="stylesheet" />
    <style>
        @font-face {
            font-family: 'open-sans';
            src: url('<?php echo base_url(); ?>assets/fonts/OpenSans/OpenSans-SemiBold.ttf');
        }
    </style>
</head>

<body class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-5 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-primary opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-1">IoTMES</h1>
                        <p class="text-lead text-white">Manufacturing execution systems (MES) are computerized systems used in manufacturing to track and document the transformation of raw materials to finished goods.</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <div class="row mt-lg-n7 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class=" text-center pt-4">
                            <!-- <img src="<?php echo base_url(); ?>assets/img/iot/new-logo-cropped.png" style="height: 50px;" alt="main_logo"> -->
                            <h5>Log In</h5>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="<?php echo base_url(); ?>pages/login_validation">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Userame" name="username" aria-label="Name">
                                </div>
                                <!-- <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email">
                                </div> -->
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Password">
                                </div>
                                <!-- <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                    </label>
                                </div> -->
                                <div class="text-center">
                                    <button type="submit" value="Submit" class="btn bg-gradient-primary w-100 my-4 mb-2" name="insert">Log In</button>
                                </div>
                                <?php
                                echo '<label class="text-danger">' . $this->session->flashdata("error") . '</label>';
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Company
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        About Us
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Team
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Products
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Blog
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Pricing
                    </a>
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright © <script>
                            document.write(new Date().getFullYear())
                        </script> Soft by Creative Tim.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/chartjs.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/all.js"></script>
</body>

</html>