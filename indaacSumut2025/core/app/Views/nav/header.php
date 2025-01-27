<?php
$session        = session();
$namaEvent      = $session->get('namaEvent');
$namaPeserta    = $session->get('namaPeserta');
$kodePeserta    = $session->get('kodePeserta');
$namaOperator   = $session->get('namaOperator');
$username       = $session->get('username');
$hakAkses       = $session->get('hakAkses');
$namaHakAkses   = $session->get('namaHakAkses');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>IndaccSumut2025 | Register.co.id</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="iconRegoBlack.png" rel="icon" />
    <link href="iconRegoBlack.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets_admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets_admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets_admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets_admin/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets_admin/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets_admin/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets_admin/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets_admin/css/style.css" rel="stylesheet" />

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url() ?>DashboardOperator" class="logo d-flex align-items-center">
                <img src="iconRegoBlack.png" alt="" />
                <span class="d-none d-lg-block"><?= $namaEvent ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php
                            if ($hakAkses == 2 || $hakAkses == 3) { ?>
                                <?= $namaOperator ?>
                            <?php
                            } else if ($hakAkses == 4 || $hakAkses == 5 || $hakAkses == 6) { ?>
                                <?= $namaPeserta ?>
                            <?php
                            }
                            ?>
                        </span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <?php
                            if ($hakAkses == 2 || $hakAkses == 3) { ?>
                                <h6><?= $namaOperator ?></h6>
                                <hr> <?= $namaHakAkses ?><br>
                            <?php
                            } else if ($hakAkses == 4 || $hakAkses == 5 || $hakAkses == 6) { ?>
                                <h6><?= $namaPeserta ?></h6>
                            <?php
                            }
                            ?>
                            <span><?= $namaEvent ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>Keluar">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->