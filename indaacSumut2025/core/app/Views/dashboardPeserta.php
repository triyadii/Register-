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
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modalGantiProfile"><button
                                                class="btn btn-primary w-100" type="submit"
                                                style="margin-top: 10px;">Ganti Foto
                                                Profile</button></a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modalBarcode"><button
                                                class="btn btn-primary w-100" type="submit"
                                                style="margin-top: 10px;">Barcode</button></a>
                                        <a
                                            href="<?= base_url() ?>DownloadBarcode/<?= $dataPeserta[0]['kodePeserta'] ?>"><button
                                                class="btn btn-primary w-100" type="submit"
                                                style="margin-top: 10px;">Download Barcode</button></a>
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
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <span style="font-weight: bold;">Nomor Induk Kependudukan : </span><br>
                                            <span><?= $dataPeserta[0]['nikPeserta'] ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: bold;">Nama : </span><br>
                                            <span><?= $dataPeserta[0]['namaPeserta'] ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: bold;">Nomor Telepon : </span><br>
                                            <span><?= $dataPeserta[0]['nomorTeleponPeserta'] ?></span>
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
                                    <div class="col-6">
                                        <div>
                                            <span style="font-weight: bold;">Email : </span><br>
                                            <span><?= $dataPeserta[0]['emailPeserta'] ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: bold;">Nama Klinik : </span><br>
                                            <span><?= $dataPeserta[0]['namaKlinik'] ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: bold;">Alamat Klinik : </span><br>
                                            <span><?= $dataPeserta[0]['alamatKlinik'] ?></span>
                                        </div>
                                        <div>
                                            <span style="font-weight: bold;">Username : </span><br>
                                            <span><?= $dataPeserta[0]['username'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEdit"><button
                                        class="btn btn-primary w-100" type="submit" style="margin-top: 10px;">Edit
                                        Profile</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<!-- Modal Ganti Profile -->
<div class="modal fade" id="modalBarcode" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" align="center">
                <div class="barcode-conatiner">
                    <?php
                    echo $generator['barcode'];
                    ?>

                    <span class="barcode-text"><?php echo $generator['text'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ganti Profile -->
<div class="modal fade" id="modalGantiProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="UpdateFotoProfil/<?= $dataPeserta[0]['idPeserta'] ?>"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <h5>Upload Foto</h5>
                    <div class="input-group">
                        <input type="file" name="foto" id="upload" onchange="pathGambarBuktiBayar(this);">
                    </div>
                    <img id="imageBuktiBayar" style=" width:100%; height:300px;   margin:0 auto; margin-top:10px;">
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Ganti Foto Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ganti Profile -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="EditProfil/<?= $dataPeserta[0]['idPeserta'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Nama Lengkap</label>
                    <div class="input-group">
                        <input type="text" name="namaPeserta" class="form-control"
                            value="<?= $dataPeserta[0]['namaPeserta'] ?>">
                    </div>
                    <label>Email</label>
                    <div class="input-group">
                        <input type="text" name="emailPeserta" class="form-control"
                            value="<?= $dataPeserta[0]['emailPeserta'] ?>">
                    </div>
                    <label>Nama Klinik</label>
                    <div class="input-group">
                        <input type="text" name="namaKlinik" class="form-control"
                            value="<?= $dataPeserta[0]['namaKlinik'] ?>">
                    </div>
                    <label>Alamat Klinik</label>
                    <div class="input-group">
                        <input type="text" name="alamatKlinik" class="form-control"
                            value="<?= $dataPeserta[0]['alamatKlinik'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Ganti Foto Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function pathGambarBuktiBayar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imageBuktiBayar').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php
include('nav/footer.php');
?>