<?php
include('nav/header.php');
include('nav/sidebarOperator.php');
?>



<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Peserta</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Peserta</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($dataPeserta as $dp) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $dp['kodePeserta'] ?></td>
                                        <td><?= $dp['nikPeserta'] ?></td>
                                        <td><?= $dp['namaPeserta'] ?></td>
                                        <td><?= $dp['alamatPeserta'] ?></td>
                                        <td><?= $dp['nomorTeleponPeserta'] ?></td>
                                        <td>
                                            <img src="https://api.register.co.id/uploads/foto/<?= $dp['foto'] ?>"
                                                style="width: 100%;">
                                        </td>
                                        <td>
                                            <?php
                                            if ($dp['statusPembayaranPeserta']  == 0) { ?>
                                                <span style="color:red;">Belum Pembayaran</span>
                                            <?php
                                            } else if ($dp['statusPembayaranPeserta'] == 1) { ?>
                                                <span style="color:gray;">Menunggu Konfirmasi</span>
                                            <?php
                                            } else if ($dp['statusPembayaranPeserta'] == 2) { ?>
                                                <span style="color:green;">Pembayaran Tervalidasi</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalBuktiBayar<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-eye" style="color:green;"></i></a>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalKonfirmasiPembayaran<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-cash" style="color:green;"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Valid -->
                                    <div class="modal fade" id="modalKonfirmasiPembayaran<?= $dp['idPeserta']; ?>"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Validasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda akan Konfirmasi Pembayaran Ini ? </p>
                                                    <div class="form-floating mb-3">
                                                        <a
                                                            href="<?= base_url() ?>KonfirmasiPembayaranPeserta/<?= $dp['idPeserta'] ?>/2"><button
                                                                class="btn btn-primary w-100" type="submit"
                                                                style="background-color:green; border-color:green;">Konfirmasi
                                                                Pembayaran</button></a><br><br>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Valid -->
                                    <div class="modal fade" id="modalBuktiBayar<?= $dp['idPeserta']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Bukti Bayar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="https://api.register.co.id/uploads/buktiBayar/<?= $dp['buktiBayar'] ?>"
                                                        style="width: 100%;">
                                                </div>
                                                </form>
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
<!-- End #main -->

<?php
include('nav/footer.php');
?>