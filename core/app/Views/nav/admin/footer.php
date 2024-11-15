<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Rego</span></strong>. All Rights Reserved
    </div>
</footer>
<!-- End Footer -->

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