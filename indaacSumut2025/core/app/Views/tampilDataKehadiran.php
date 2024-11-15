<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1";
?>
<html>

<head>
    <meta http-equiv="refresh" content="<?php echo $sec ?>;URL='<?= base_url() ?>ScanBarcodeRegister'">
</head>

<body>
    <?php
    echo "Watch the page reload itself in 10 second!";
    ?>
</body>

</html>