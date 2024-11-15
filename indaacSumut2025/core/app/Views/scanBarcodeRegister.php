<?php
include('nav/header.php');
include('nav/sidebarOperator.php');
?>



<main id="main" class="main">
    <div class="pagetitle">
        <h1>Scan Barcode Registrasi</h1>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <!-- Scan Barcode Register -->
                                </h5>
                                <form method="POST" action="KonfirmasiKehadiran" id="autoForm"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <video id="previewKamera" style="width:100%; height:350px;"></video>
                                            <br>
                                        </div>
                                        <div class=" col-12">
                                            <label for="yourUsername" class="form-label">Scan Barcode Registrasi</label>
                                            <span style="color: red; font-size:10px;">*</span>
                                            <div class="input-group has-validation">
                                                <input type="text" id="hasilscan" name="kodePeserta"
                                                    class="form-control" id="yourUsername" onchange="autoSubmit()"
                                                    required>
                                            </div>
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
</main>

<!-- Proses Kamera Scan -->
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
let selectedDeviceId = null;
const codeReader = new ZXing.BrowserMultiFormatReader();
const sourceSelect = $("#pilihKamera");

$(document).on('change', '#pilihKamera', function() {
    selectedDeviceId = $(this).val();
    if (codeReader) {
        codeReader.reset()
        initScanner()
    }
})


function initScanner() {
    codeReader
        .listVideoInputDevices()
        .then(videoInputDevices => {
            videoInputDevices.forEach(device =>
                console.log(`${device.label}, ${device.deviceId}`)
            );

            if (videoInputDevices.length > 0) {

                if (selectedDeviceId == null) {
                    if (videoInputDevices.length > 1) {
                        selectedDeviceId = videoInputDevices[1].deviceId
                    } else {
                        selectedDeviceId = videoInputDevices[0].deviceId
                    }
                }


                if (videoInputDevices.length >= 1) {
                    sourceSelect.html('');
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        if (element.deviceId == selectedDeviceId) {
                            sourceOption.selected = 'selected';
                        }
                        sourceSelect.append(sourceOption)
                    })

                }

                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {

                        //hasil scan
                        console.log(result.text)
                        $("#hasilscan").val(result.text);
                        if (codeReader) {
                            document.forms["autoForm"].submit();
                            codeReader.reset()
                        }
                    })
                    .catch(err => console.error(err));

            } else {
                alert("Camera not found!")
            }
        })
        .catch(err => console.error(err));
}


if (navigator.mediaDevices) {
    initScanner()
} else {
    alert('Cannot access camera.');
}
</script>
<!-- End #main -->

<?php
include('nav/footer.php');
?>