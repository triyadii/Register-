<?php
$session    = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>IndAAC Sumut 2025 | Registrasi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/iconRego.png" rel="icon">
    <link href="assets/img/iconRego.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets_admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_admin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets_admin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets_admin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_admin/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <!-- Template Main CSS File -->
    <link href="assets_admin/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Daftarkan Diri anda di Acara
                                            IndaacSumut2025</h5>
                                        <p class="text-center small">Silahkan isi data di bawah ini untuk melakukan
                                            registrasi</p>
                                    </div>
                                    <form method="POST" action="Register" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="yourUsername" class="form-label">Nomor Induk
                                                    Kependudukan</label> <span
                                                    style="color: red; font-size:10px;">*</span>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="nik" class="form-control" id="yourUsername"
                                                        placeholder="Masukkan Nomor Induk Kependudukan" required>
                                                    <div class="invalid-feedback">Masukkan Nomor Induk Kependudukan
                                                    </div>
                                                </div>
                                                <label for="yourUsername" class="form-label">Nama </label><span
                                                    style="color: red; font-size:10px;">*</span>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="nama" class="form-control"
                                                        id="yourUsername" placeholder="Masukkan Nama Lengkap" required>
                                                </div>
                                                <label for="yourUsername" class="form-label">Alamat
                                                    Lengkap</label><span style="color: red; font-size:10px;">*</span>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="alamat" class="form-control"
                                                        id="yourUsername" placeholder="Masukkan Alamat Lengkap"
                                                        required>
                                                </div>
                                                <label for="yourUsername" class="form-label">Nomor Telepon<span
                                                        style="color: red; font-size:10px;">*</span>
                                                    <span style="color: red; font-size : 10px;">(ex :
                                                        082276156253)</span></label>
                                                <div class="input-group has-validation">
                                                    <input type="number" name="nomorTelepon" class="form-control"
                                                        id="yourUsername"
                                                        placeholder="masukkan Nomor Telepon ex: 082276156253" required>
                                                </div>
                                                <label for="yourUsername" class="form-label">Foto</label>
                                                <div class="input-group     ">
                                                    <input type="file" name="foto" id="upload"
                                                        onchange="readURL(this);">
                                                </div>

                                            </div>
                                            <img id="image"
                                                style=" width:100%; height:300px; margin:0 auto; margin-top: 3%;">
                                            <div class="col-12" style="margin-top:3%;">
                                                <button class="btn btn-primary w-100" type="submit">Registrasi</button>
                                            </div>
                                            <div class="col-12">
                                                <br>
                                                <p class="small mb-0">anda sudah memiliki akun ? <a
                                                        href="<?= base_url() ?>Login">Silahkan Masuk Dengan Akun
                                                        Anda</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
        </div>

        </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets_admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_admin/vendor/chart.js/chart.umd.js"></script>
    <script src="assets_admin/vendor/echarts/echarts.min.js"></script>
    <script src="assets_admin/vendor/quill/quill.min.js"></script>
    <script src="assets_admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets_admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets_admin/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets_admin/js/main.js"></script>

    <!-- Sweet Alert -->
    <script script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <?php
    $dataSession = $session->get('status');
    $dataKeterangan = $session->get('keterangan');
    if ($dataSession == "Berhasil") {
    ?>
        <script>
            swal("Selamat ! ", "<?= $dataKeterangan; ?>", "success");
        </script>
    <?php
        $arraySession = ['status', 'keterangan'];
        $session->remove($arraySession);
    } else if ($dataSession == "Gagal") {
    ?>
        <script>
            swal("Gagal ! ", "<?= $dataKeterangan; ?>", "error");
        </script>
    <?php
        $arraySession = ['status', 'keterangan'];
        $session->remove($arraySession);
    }
    ?>


</body>

</html>