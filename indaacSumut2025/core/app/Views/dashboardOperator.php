<?php
include('nav/header.php');
include('nav/sidebarOperator.php');
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
                                        <img src="<?= base_url() ?>kosong.jpg" style="width:100%;">
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
                                    Data <?= $namaHakAkses ?> <?= $dataOperator[0]['namaEvent'] ?>
                                </h5>
                                <div>
                                    <span style="font-weight: bold;">Nama : </span><br>
                                    <span><?= $dataOperator[0]['namaOperator'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Nomor Telepon : </span><br>
                                    <span><?= $dataOperator[0]['nomorTeleponOperator'] ?></span>
                                </div>
                                <div>
                                    <span style="font-weight: bold;">Alamat : </span><br>
                                    <span><?= $dataOperator[0]['alamatOperator'] ?></span>
                                </div>
                                <br>
                                <?php
                                if ($hakAkses == 3) { ?>
                                <div class="row">

                                    <div class="col-6">
                                        <a href="<?= base_url() ?>ScanBarcodeRegister" target="_blank"><button
                                                class="btn btn-primary w-100" type="submit">Scan Barcode
                                                Registrasi</button></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?= base_url() ?>ScanBarcodeMasuk" target="_blank"><button
                                                class="btn btn-primary w-100" type="submit">Scan Barcode
                                                Masuk</button></a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <a href=" <?= base_url() ?>Peserta"><button class="btn btn-primary w-100"
                                                type="submit">Data Peserta</button></a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <br>
                                </div>
                                <?php
                                } else if ($hakAkses == 2) { ?>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalUploadLinkMateri"><button
                                                class="btn btn-primary w-100" type="submit">Upload Link
                                                Materi</button></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalUploadTemplateSertifikat"><button
                                                class="btn btn-primary w-100" type="submit">Upload Template
                                                Sertifikat</button></a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalUploadLinkVideoDanGaleri"><button
                                                class="btn btn-primary w-100" type="submit">Upload Link Video Dan
                                                Galeri</button></a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="col-12" style="margin-top:3%;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Upload Link Materi -->
    <div class="modal fade" id="modalUploadLinkMateri" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Link Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="Register" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Link Materi</label> <span
                                    style="color: red; font-size:10px;">*</span>
                                <div class="input-group has-validation">
                                    <input type="text" name="linkMateri" class="form-control" id="yourUsername"
                                        placeholder="Masukkan Link Materi" required>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top:3%;">
                                <button class="btn btn-primary w-100" type="submit">Registrasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Upload Template Sertifikat -->
    <div class="modal fade" id="modalUploadTemplateSertifikat" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Link Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="Register" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Template Sertifikat</label> <span
                                    style="color: red; font-size:10px;">*</span>
                                <div class="input-group has-validation">
                                    <input type="file" name="templateSertifikat" class="form-control" id="yourUsername"
                                        placeholder="Masukkan Template Sertifikat" required>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top:3%;">
                                <button class="btn btn-primary w-100" type="submit">Registrasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Upload Link Video dan Galeri -->
    <div class="modal fade" id="modalUploadLinkVideoDanGaleri" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Link Video dan Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="Register" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Link Video dan Galeri</label> <span
                                    style="color: red; font-size:10px;">*</span>
                                <div class="input-group has-validation">
                                    <input type="text" name="linkVideoDanGaleri" class="form-control" id="yourUsername"
                                        placeholder="Masukkan Link Video Dan Galeri" required>
                                </div>
                            </div>
                            <div class="col-12" style="margin-top:3%;">
                                <button class="btn btn-primary w-100" type="submit">Registrasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Scan Barcode Register -->
    <div class="modal fade" id="modalScanBarcodeRegister" tabindex="-1">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scan Barcode Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="KonfirmasiKehadiran" id="autoForm" enctype="multipart/form-data"
                        id="paymentForm">
                        <div class="row">
                            <div class="col-12">
                                <video id="previewKamera" style="width:100%"></video>
                                <br>
                            </div>
                            <div class=" col-12">
                                <label for="yourUsername" class="form-label">Scan Barcode Registrasi</label> <span
                                    style="color: red; font-size:10px;">*</span>
                                <div class="input-group has-validation">
                                    <input type="text" id="hasilscan" name="kodePeserta" class="form-control"
                                        id="yourUsername" onchange="autoSubmit()" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End #main -->

<?php
include('nav/footer.php');
?>