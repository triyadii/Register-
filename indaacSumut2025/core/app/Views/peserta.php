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
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Jenis</th>
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
                                        <td><?= $dp['username'] ?></td>
                                        <td><?= $dp['namaPeserta'] ?></td>
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
                                            <?php
                                            if ($dp['kehadiran']  == 0) { ?>
                                                <span style="color:red;">Belum Registrasi</span>
                                            <?php
                                            } else if ($dp['kehadiran'] == 1) { ?>
                                                <span style="color:gray;">Sudah Registrasi</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($dp['peserta']  == 0 && $dp['panitia'] == 0 && $dp['moderator'] == 0 && $dp['stand'] == 0) { ?>
                                                <span style="color:red;">Jenis Belum Di Tentukan</span>
                                            <?php
                                            } else { ?>
                                                <?php
                                                if ($dp['peserta']  == 0) { ?>
                                                    <i class="bi bi-x-lg" style="color:red;"></i><span> Peserta</span><br>
                                                <?php
                                                } else { ?>
                                                    <i class="bi bi-check-lg" style="color:green;"></i><span> Peserta</span><br>
                                                <?php
                                                }
                                                if ($dp['panitia']  == 0) { ?>
                                                    <i class="bi bi-x-lg" style="color:red;"></i><span> Panitia</span><br>
                                                <?php
                                                } else { ?>
                                                    <i class="bi bi-check-lg" style="color:green;"></i><span> Panitia</span><br>
                                                <?php
                                                }
                                                if ($dp['moderator']  == 0) { ?>
                                                    <i class="bi bi-x-lg" style="color:red;"></i><span> Moderator</span><br>
                                                <?php
                                                } else { ?>
                                                    <i class="bi bi-check-lg" style="color:green;"></i><span> Moderator</span><br>
                                                <?php
                                                }
                                                if ($dp['stand']  == 0) { ?>
                                                    <i class="bi bi-x-lg" style="color:red;"></i><span> Stand</span><br>
                                                <?php
                                                } else { ?>
                                                    <i class="bi bi-check-lg" style="color:green;"></i><span> Stand</span><br>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalBuktiBayar<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-eye" style="color:green;"></i><span style="color: green;">
                                                    Bukti</span></a><br>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalKonfirmasiPembayaran<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-cash" style="color:green;"></i><span style="color: green;">
                                                    validasi</span></a><br>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailPeserta<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-person-badge-fill" style="color:green;"></i>
                                                <span style="color: green;">
                                                    Detail</span></a><br>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalPemilihanJenis<?= $dp['idPeserta']; ?>"> <i
                                                    class="bi bi-people-fill" style="color:green;"></i><span
                                                    style="color: green;">
                                                    Peserta</span><br></a>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit<?= $dp['idPeserta']; ?>"> <i class="bi bi-pencil"
                                                    style="color:gray;"></i>
                                                <span style="color: green;">
                                                    Edit</span></a><br>
                                            <a
                                                href="<?= base_url() ?>GenerateQrCode/P<?= $dp['idPeserta']; ?>/<?= $dp['namaPeserta']; ?>">
                                                <i class="bi bi-upc" style="color:gray;"></i>
                                                <span style="color: green;">
                                                    QrCode</span></a><br>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modalValidasiHapus<?= $dp['idPeserta']; ?>"><i
                                                    class="bi bi-trash" style="color: red;"></i>
                                                <span style="color: red;">
                                                    Hapus</span></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEdit<?= $dp['idPeserta']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Peserta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="EditDataPeserta/<?= $dp['idPeserta']; ?>"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p class="text-left small">Username
                                                                </p>
                                                                <div class="input-group has-validation">
                                                                    <input type="text" class="form-control" name="username"
                                                                        value="<?= $dp['username'] ?>">
                                                                </div>
                                                                <p class="text-left small">Nomor Induk Kependudukan Peserta
                                                                </p>
                                                                <div class="input-group has-validation">
                                                                    <input type="text" class="form-control"
                                                                        name="nikPeserta" value="<?= $dp['nikPeserta'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="text-left small">Nama Peserta
                                                                </p>
                                                                <div class="input-group has-validation">
                                                                    <input type="text" class="form-control"
                                                                        name="namaPeserta"
                                                                        value="<?= $dp['namaPeserta'] ?>">
                                                                </div>
                                                                <p class="text-left small">Nomor Telepon Peserta
                                                                </p>
                                                                <div class="input-group has-validation">
                                                                    <input type="text" class="form-control"
                                                                        name="nomorTeleponPeserta"
                                                                        value="<?= $dp['nomorTeleponPeserta'] ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary w-100" type="submit"
                                                            style="background-color:green; border-color:green;">Edit Data
                                                            Peserta</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Pemilihan Jenis -->
                                    <div class="modal fade" id="modalPemilihanJenis<?= $dp['idPeserta']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Pemilihan Jenis Peserta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="UpdateJenisPeserta/<?= $dp['idPeserta']; ?>"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <p>Silahkan Pilih Jenis Peserta </p>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($dp['peserta'] == 0) { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" value="1" name="peserta">
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Peserta
                                                                        </label>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" name="peserta"
                                                                            value=<?= $dp['peserta'] ?> checked>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Peserta
                                                                        </label>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($dp['panitia'] == 0) { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" value="1" name="panitia">
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Panitia
                                                                        </label>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" name="panitia"
                                                                            value=<?= $dp['panitia'] ?> checked>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Panitia
                                                                        </label>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($dp['moderator'] == 0) { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" value="1" name="moderator">
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Moderator
                                                                        </label>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" name="moderator"
                                                                            value=<?= $dp['moderator'] ?> checked>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Moderator
                                                                        </label>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($dp['stand'] == 0) { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" value="1" name="stand">
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Stand
                                                                        </label>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="gridCheck1" name="stand"
                                                                            value=<?= $dp['stand'] ?> checked>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                            Stand
                                                                        </label>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary w-100" type="submit"
                                                            style="background-color:green; border-color:green;">Update Jenis
                                                            Peserta</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="modalValidasiHapus<?= $dp['idPeserta']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Validasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda akan Menghapus Data Ini ? </p>
                                                    <div class="form-floating mb-3">
                                                        <a href="<?= base_url() ?>HapusPeserta/<?= $dp['idPeserta'] ?>"><button
                                                                class="btn btn-primary w-100" type="submit"
                                                                style="background-color:red; border-color:red;">Hapus
                                                                Peserta</button></a><br><br>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Validasi -->
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
                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="modalDetailPeserta<?= $dp['idPeserta']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Peserta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class="text-left small">Kode Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['kodePeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">Id Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['idPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">Kode Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['username'] ?>">
                                                            </div>

                                                            <p class="text-left small">Nomor Induk Kependudukan Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['nikPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">Nama Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['namaPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">Nomor Telepon Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['nomorTeleponPeserta'] ?>">
                                                            </div>

                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-left small">
                                                                Email Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['emailPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">
                                                                Nama Rekening Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['namaRekeningPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">
                                                                Nomor Rekening Peserta
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['nomorRekeningPeserta'] ?>">
                                                            </div>
                                                            <p class="text-left small">
                                                                Nama Klinik
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['namaKlinik'] ?>">
                                                            </div>
                                                            <p class="text-left small">
                                                                Alamat Klinik
                                                            </p>
                                                            <div class="input-group has-validation">
                                                                <input type="text" class="form-control"
                                                                    value="<?= $dp['alamatKlinik'] ?>">
                                                            </div>
                                                        </div>
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
                                                    <?php
                                                    if ($dp['buktiBayar'] == null) { ?>
                                                        <h5 style="color:red;">Mohon maaf, Bukti bayar belum di upload</h5>
                                                    <?php
                                                    } else { ?>
                                                        <img src="https://api.register.co.id/uploads/buktiBayar/<?= $dp['buktiBayar'] ?>"
                                                            style="width: 100%;">
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <a
                                                        href="https://api.register.co.id/api/DownloadBuktiBayar/<?= $dp['idPeserta'] ?>"><button
                                                            class="btn btn-primary w-100" type="submit"
                                                            style="background-color:green; border-color:green;">Download
                                                            Bukti Bayar</button></a><br><br>
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