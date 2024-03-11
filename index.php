<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trafic Counter</title>


    <link rel="shortcut icon" href="./asset/traffic.png">

    <!-- Framework dan stack lain -->
    <script src="https://kit.fontawesome.com/c2b7ee3658.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="index.css">

</head>

<body>

    <main class="container">

        <section id="item-1" class="section">
            <input name="sm" id="item-number-1" class="item" disabled> </input>
            <button id="item-button-1" class="item">
                <span class="kode-kendaraan">SM</span>
                <img class="gambar" src="./asset/sm.png" alt="SM">
            </button>
        </section>

        <section id="item-2" class="section">
            <input name="mp" id="item-number-2" class="item" disabled> </input>
            <button id="item-button-2" class="item">
                <span class="kode-kendaraan">MP</span>
                <img class="gambar" src="./asset/mp.png" alt="MP">
            </button>
        </section>


        <section id="item-3" class="section">
            <input name="ks" id="item-number-3" class="item" disabled> </input>
            <button id="item-button-3" class="item">
                <span class="kode-kendaraan">KS</span>
                <img class="gambar" src="./asset/ks.png" alt="KS">
            </button>
        </section>

        <section id="item-4" class="section">
            <input name="bb" id="item-number-4" class="item" disabled> </input>
            <button id="item-button-4" class="item">
                <span class="kode-kendaraan">BB</span>
                <img class="gambar" src="./asset/sm.png" alt="BB">
            </button>
        </section>

        <section id="item-5" class="section">
            <input name="tb" id="item-number-5" class="item" disabled> </input>
            <button id="item-button-5" class="item">
                <span class="kode-kendaraan">TB</span>
                <img class="gambar" src="./asset/sm.png" alt="TB">
            </button>
        </section>


        <section id="item-6" class="section">
            <div id="item-6-left-side">
                <button id="item-tanggal" class="item"> </button>
                <button id="item-waktu" class="item"> </button>
            </div>
            <div id="item-6-right-side">
                <button id="item-reset" class="item"> Reset </button>
                <button id="item-set" class="item"> Set </button>
                <button id="item-stop" class="item"> Stop </button>

                <button id="item-data" class="item"> Data </button>
            </div>
        </section>


        <section id="item-7" class="d-flex justify-content-center align-items-center mt-5">
            <a href="stopwatch.php"><button id="item-stopwatch">Stopwatch <i class="fa-solid fa-up-right-from-square"></i></button></a>

        </section>

    </main>




    <!----------------------TODO Modal Popup--------------------->
    <div class="modal" id="modal-data-disimpan" tabindex="-2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Data tersimpan otomatis.</p>
                    <!-- <p id="response"></p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-data-disimpan-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tidak-bisa-reset" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Set interval sedang aktif,<strong> <i> reset </i></strong> gagal! </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-tidak-bisa-reset-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tanya-reset" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Apakah anda yakin melakukan <strong> <i> reset </i></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-verify-reset" class="btn btn-light" data-bs-dismiss="modal"> Ya </button>
                    <button type="button" id="modal-tanya-reset-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tidak </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tanya-download" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download file</h5>
                </div>
                <div class="modal-body">
                    <p>Ingin mendownload <strong> <i> traffic_data.xlsx </i></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-tanya-download-tutup" class="btn btn-light" data-bs-dismiss="modal"> Tidak </button>
                    <a href="traffic_data.xlsx"> <button type="button" id="btn-verify-download" class="btn btn-primary" data-bs-dismiss="modal"> Ya </button></a>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tidak-bisa-download" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Set interval sedang aktif, download file <strong> <i> traffic_data.xlsx </i></strong> gagal! </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-tidak-bisa-download-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------TODO Modal Popup--------------------->



    <script>
        var isSetActive = false;
        var startInterval = '';
        var endInterval = '';
        var timeOutID = null;

        $(document).ready(function() {

            /*-------------------------------TODO CLICK LISTENER -------------------------------*/
            $("#item-button-1").click(function() {
                $("#item-number-1").val(parseInt($("#item-number-1").val()) + 1);

                setSession();
            });

            $("#item-button-2").click(function() {
                $("#item-number-2").val(parseInt($("#item-number-2").val()) + 1);

                setSession();
            });

            $("#item-button-3").click(function() {
                $("#item-number-3").val(parseInt($("#item-number-3").val()) + 1);

                setSession();
            });

            $("#item-button-4").click(function() {
                $("#item-number-4").val(parseInt($("#item-number-4").val()) + 1);

                setSession();
            });

            $("#item-button-5").click(function() {
                $("#item-number-5").val(parseInt($("#item-number-5").val()) + 1);

                setSession();
            });


            // RESET
            $("#item-reset").click(function() {

                if (isSetActive) {
                    modalTidakBisaReset();
                } else {

                    modalTanyaReset();

                    $('#btn-verify-reset').click(function() {
                        $('#modal-tanya-reset').hide();
                        reset();
                    });

                }

            });

            // SET
            $("#item-set").click(function() {
                isSetActive = true;
                startInterval = getStartInterval();

                timeOutID = set15MinutesTimeOut();

                $("#item-stop").css({
                    'display': 'block',
                });

                $("#item-set").css({
                    'display': 'none',
                });

            });

            // STOP
            $("#item-stop").click(function() {
                isSetActive = false;
                endInterval = getEndInterval();

                clearTimeout(timeOutID);

                sendData();

                $("#item-set").css({
                    'display': 'block',
                });

                $("#item-stop").css({
                    'display': 'none',
                });
            });



            // DATA
            $("#item-data").click(function() {

                if (isSetActive) {
                    modalTidakBisaDownload();
                } else {

                    modalTanyaDownload();

                    $('#btn-verify-download').click(function() {
                        $('#modal-tanya-download').hide();
                    });

                }

            });


            /*-------------------------------TODO CLICK LISTENER -------------------------------*/


            /*-------------------------------TODO MODAL -------------------------------*/

            function modalDataDisimpan() {
                $('#modal-data-disimpan').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modal-data-disimpan').show();

                $('#modal-data-disimpan-tutup').click(function() {
                    $('#modal-data-disimpan').hide();
                });
            }

            function modalTanyaReset() {
                $('#modal-tanya-reset').modal({
                    backdrop: 'static',
                    keyboard: false
                });


                $('#modal-tanya-reset').show();

                $('#modal-tanya-reset-tutup').click(function() {
                    $('#modal-tanya-reset').hide();
                });
            }

            function modalTidakBisaReset() {

                $('#modal-tidak-bisa-reset').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modal-tidak-bisa-reset').show();

                $('#modal-tidak-bisa-reset-tutup').click(function() {
                    $('#modal-tidak-bisa-reset').hide();
                });

            }


            function modalTanyaDownload() {

                $('#modal-tanya-download').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modal-tanya-download').show();

                $('#modal-tanya-download-tutup').click(function() {
                    $('#modal-tanya-download').hide();
                });

            }

            function modalTidakBisaDownload() {

                $('#modal-tidak-bisa-download').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modal-tidak-bisa-download').show();

                $('#modal-tidak-bisa-download-tutup').click(function() {
                    $('#modal-tidak-bisa-download').hide();
                });

            }



            /*-------------------------------TODO MODAL -------------------------------*/


            // Fungsi Reset
            function reset() {
                $("input").val(0);

                setSession();
            }


            // Load Session
            // session digunakan agar ketika page di refresh angka tidak hilang
            for (let i = 1; i <= 5; i++) {
                let loadData = sessionStorage.getItem(`item${i}`);

                if (loadData) {
                    $(`#item-number-${i}`).val(loadData);
                } else {
                    $(`#item-number-${i}`).val(0);
                }
            }

            // Membuat Session
            function setSession() {
                for (let i = 1; i <= 5; i++) {
                    sessionStorage.setItem(`item${i}`, $(`#item-number-${i}`).val());
                }
            }


            // Tanggal
            let now = new Date();
            let currentDate = now.toLocaleDateString();
            $('#item-tanggal').html(currentDate);

            // waktu awal sblm refresh
            $("#item-waktu").html("-   :   -   :   -");

            // update jam 
            function updateClock() {

                let now = new Date();

                // Waktu jam-menit-detik
                let hours = now.getHours();
                let minutes = now.getMinutes();
                let seconds = now.getSeconds();

                // Untuk tambahkan nol di depan ketika jam hanya 1 digit
                hours = (hours < 10 ? "0" : "") + hours;
                minutes = (minutes < 10 ? "0" : "") + minutes;
                seconds = (seconds < 10 ? "0" : "") + seconds;

                let timeString = hours + ":" + minutes + ":" + seconds;
                $("#item-waktu").html(timeString)


                // Styling
                $("#item-waktu").css({
                    'color': 'white',
                    'background-color': 'rgb(3, 10, 52)',
                });

            }

            // Update jam-menit-detik setiap detik
            setInterval(updateClock, 1000);



            function getStartInterval() {
                let tgl = $('#item-tanggal').text();
                let waktu = $('#item-waktu').text();

                let start = tgl + " , " + waktu;

                return start;
            }

            function getEndInterval() {
                let waktu = $('#item-waktu').text();

                return $('#item-waktu').text();
            }

            function getInterval() {
                let interval = startInterval + " - " + endInterval;
                return interval;
            }


            function set15MinutesTimeOut(type = 'auto') {
                let tm = setTimeout(function() {

                    endInterval = getEndInterval();
                    sendData();

                    $("#item-set").css({
                        'display': 'block',
                    });

                    $("#item-stop").css({
                        'display': 'none',
                    });

                }, 15 * 60 * 1000);

                return tm;
            }


            function getDurasi() {

                var detik, menit;

                let regex = /:(\d{2}):(\d{2})/;

                let waktuStart = regex.exec(startInterval);
                let menitStart = parseInt(waktuStart[1]);
                let detikStart = parseInt(waktuStart[2]);

                let waktuEnd = regex.exec(endInterval);
                let menitEnd = parseInt(waktuEnd[1]);
                let detikEnd = parseInt(waktuEnd[2]);

                if (menitStart != menitEnd) {
                    let detikHitung = (60 - detikStart) + detikEnd;
                    let menitHitung = (menitEnd - (menitStart + 1)) * 60;

                    let totalDetik = detikHitung + menitHitung;

                    detik = totalDetik % 60;
                    menit = (totalDetik - detik) / 60;
                } else {
                    detik = detikEnd - detikStart;
                    menit = 0;
                }

                let durasi = menit.toString() + " Menit " + detik.toString() + " Detik";

                return durasi;
            }



            function sendData() {
                isSetActive = false;

                let sm = $('#item-number-1').val();
                let mp = $('#item-number-2').val();
                let ks = $('#item-number-3').val();
                let bb = $('#item-number-4').val();
                let tb = $('#item-number-5').val();

                let data = {
                    type: 'INSERT DATA',
                    interval: getInterval(),
                    durasi: getDurasi(),
                    sm: sm,
                    mp: mp,
                    ks: ks,
                    bb: bb,
                    tb: tb,
                }

                $.ajax({
                    type: "POST",
                    data: data,
                    success: function(response) {
                        modalDataDisimpan();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log(xhr.responseText);
                    }
                });

            }

        });
    </script>






    <?php

    require_once('config/database.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $interval = $_POST['interval'];
        $durasi = $_POST['durasi'];
        $sm = $_POST['sm'];
        $mp = $_POST['mp'];
        $ks = $_POST['ks'];
        $bb = $_POST['bb'];
        $tb = $_POST['tb'];


        $user = new DATA($interval, $durasi, $sm, $mp, $ks, $bb, $tb);
        $user->simpanData();
        $user->exportDataToSpreadsheet();
    }

    ?>


</body>

</html>