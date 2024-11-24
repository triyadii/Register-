<?php
$session = session();
$page = $_SERVER['PHP_SELF'];
$sec = "2";
?>
<html>

<head>
    <meta http-equiv="refresh" content="<?php echo $sec ?>;URL='<?= base_url() ?>ScanBarcodeMasuk'">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <style>
        body,
        html {
            height: 100%;
        }

        .bg {
            /* The image used */
            background-image: url("uploads/selamatDatang.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="bg"></div>
    <?= $data[0]['namaPeserta'] ?>
    <?php
    echo "Watch the page reload itself in 10 second! ";
    ?>
</body>

<!-- Sweet Alert -->
<script script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
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
} else if ($dataSession == "Peringatan") {
?>
    <script>
        swal("Peringatan ! ", "<?= $dataKeterangan; ?>", "warning");
    </script>
<?php
    $arraySession = ['status', 'keterangan'];
    $session->remove($arraySession);
}
?>


</html>