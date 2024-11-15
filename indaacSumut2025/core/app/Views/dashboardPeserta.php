<?php
include('nav/header.php');
include('nav/sidebar.php');
?>



<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-4">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Foto Peserta
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <img src="https://api.register.co.id/uploads/foto/<?= $dataPeserta[0]['foto']; ?>"
                                            style="width:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Data Peserta <?= $dataPeserta[0]['namaPeserta'] ?>
                                </h5>
                                <div>
                                    <span style="font-weight: bold;">Nomor Induk Kependudukan : </span><br>
                                    <span><?= $dataPeserta[0]['nikPeserta'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Nama : </span><br>
                                    <span><?= $dataPeserta[0]['namaPeserta'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Alamat : </span><br>
                                    <span><?= $dataPeserta[0]['alamatPeserta'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Nomor Telepon : </span><br>
                                    <span><?= $dataPeserta[0]['nomorTeleponPeserta'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Username : </span><br>
                                    <span><?= $dataPeserta[0]['username'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Status Peserta : </span><br>
                                    <?php
                                    if ($dataPeserta[0]['statusPembayaranPeserta'] == 0) { ?>
                                        <span style="color: red;">Belum Melakukan Pembayaran</span>
                                    <?php
                                    } else if ($dataPeserta[0]['statusPembayaranPeserta'] == 1) { ?>
                                        <span style="color: gray;">Menunggu Validasi Pembayaran</span>
                                    <?php
                                    } else if ($dataPeserta[0]['statusPembayaranPeserta'] == 2) { ?>
                                        <span style="color: green;">Pembayaran Tervalidasi</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
<!-- End #main -->

<?php
include('nav/footer.php');
?>