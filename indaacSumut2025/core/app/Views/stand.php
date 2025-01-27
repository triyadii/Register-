<?php
include('nav/header.php');
include('nav/sidebarOperator.php');
?>



<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Penjaga Stand</h1>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="margin-top: 2%;">
                                <div class="col-lg-2">
                                    <a data-bs-toggle="modal" data-bs-target="#modalTambahBooth"><button
                                            class="btn btn-primary w-30" type="submit">Tambah
                                            Booth</button></a>
                                </div>
                                <div class="col-lg-3">
                                    <a data-bs-toggle="modal" data-bs-target="#modalCekBarcode"><button
                                            class="btn btn-primary w-30" type="submit">Pengecekan Barcode</button></a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($dataStand as $dp) {
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $dp['user'] ?></td>
                                            <td><?= $dp['perusahaan'] ?></td>
                                            <td>
                                                <?php
                                                if ($dp['berkasKTP'] != null) { ?>
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#modalBuktiBayar<?= $dp['idPenjagaStand']; ?>"><i
                                                            class="bi bi-eye" style="color:green;"></i> <span
                                                            style="color: green;">Lihat KTP </span></a> <br>
                                                <?php
                                                }
                                                ?>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#modalUpdateData<?= $dp['idPenjagaStand']; ?>"><i
                                                        class="bi  bi-box-arrow-up" style="color:green;"></i> <span
                                                        style="color: green;"> Update </span> </a>
                                                <br>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#modalBarcode<?= $dp['idPenjagaStand']; ?>"><i
                                                        class="bi bi-upc" style="color: green;"></i> <span
                                                        style="color: green;"> Barcode </span></a><br>
                                                <a
                                                    href="<?= base_url() ?>GenerateQrCode/B<?= $dp['idPenjagaStand']; ?>/<?= $dp['perusahaan']; ?>">
                                                    <i class="bi bi-upc" style="color:green;"></i>
                                                    <span style="color: green;">
                                                        QrCode</span></a><br>
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#modalValidasiHapus<?= $dp['idPenjagaStand']; ?>"><i
                                                        class="bi bi-trash" style="color: red;"></i></i> <span
                                                        style="color: red;"> Hapus </span></a>
                                            </td>
                                        </tr>
                                        <!-- Modal Valid -->
                                        <div class="modal fade" id="modalBuktiBayar<?= $dp['idPenjagaStand']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Berkas KTP</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="https://api.register.co.id/uploads/stand/<?= $dp['berkasKTP'] ?>"
                                                            style="width: 100%;">
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="modalValidasiHapus<?= $dp['idPenjagaStand']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Validasi Penghapusan Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda akan Menghapus Data Ini ? </p>
                                                        <div class="form-floating mb-3">
                                                            <a
                                                                href="<?= base_url() ?>HapusPenjagaStand/<?= $dp['idPenjagaStand'] ?>"><button
                                                                    class="btn btn-primary w-100" type="submit"
                                                                    style="background-color:red; border-color:red;">Hapus
                                                                    User
                                                                    Booth</button></a><br><br>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Update data  -->
                                        <div class="modal fade" id="modalUpdateData<?= $dp['idPenjagaStand']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="UpdateBooth/<?= $dp['idPenjagaStand']; ?>"
                                                            enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label for="yourUsername" class="form-label">Berkas
                                                                        KTP</label>
                                                                    <div class="input-group has-validation">
                                                                        <input type="file" name="berkasKTP"
                                                                            class="form-control" id="yourUsername"
                                                                            placeholder="Masukkan Nama Perusahaan" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="margin-top:3%;">
                                                                    <button class="btn btn-primary w-100"
                                                                        type="submit">Update Booth</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Barcode -->
                                        <div class="modal fade" id="modalBarcode<?= $dp['idPenjagaStand']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Barcode</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" align="center">
                                                        <div class="barcode-conatiner">

                                                            <?php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                            $barcode   = $generator->getBarcode($dp['idPenjagaStand'], $generator::TYPE_CODE_128);
                                                            echo $barcode;
                                                            ?>
                                                            <span class="barcode-text"><?= $dp['idPenjagaStand']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        </section>
</main>
<!-- Modal Tambah Booth -->
<div class="modal fade" id="modalTambahBooth" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Booth</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="TambahBooth" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Perusahaan</label>
                            <div class="input-group has-validation">
                                <input type="text" name="perusahaan" class="form-control" id="yourUsername"
                                    placeholder="Masukkan Nama Perusahaan" required>
                            </div>
                            <label for="yourUsername" class="form-label">User 1</label>
                            <div class="input-group has-validation">
                                <input type="text" name="user1" class="form-control" id="yourUsername"
                                    placeholder="Masukkan User 1" required>
                            </div>
                            <label for="yourUsername" class="form-label">User 2</label>
                            <div class="input-group has-validation">
                                <input type="text" name="user2" class="form-control" id="yourUsername"
                                    placeholder="Masukkan User 2" required>
                            </div>
                            <label for="yourUsername" class="form-label">User 3</label>
                            <div class="input-group has-validation">
                                <input type="text" name="user3" class="form-control" id="yourUsername"
                                    placeholder="Masukkan User 3" required>
                            </div>

                        </div>
                        <div class="col-12" style="margin-top:3%;">
                            <button class="btn btn-primary w-100" type="submit">Tambah User Booth</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pengecekan Barcode -->
<div class="modal fade" id="modalCekBarcode" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengecekan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="CekBarcodePenjagaBooth" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Barcode</label>
                            <div class="input-group has-validation">
                                <input type="text" name="barcode" class="form-control" id="yourUsername" required>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top:3%;">
                            <button class="btn btn-primary w-100" type="submit">Cek barcode</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include('nav/footer.php');
?>