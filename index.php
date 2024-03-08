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
            <input id="item-number-1" class="item" disabled> </input>
            <button id="item-button-1" class="item">
                <span class="kode-kendaraan">SM</span>
                <img class="gambar" src="./asset/sm.png" alt="SM">
            </button>
        </section>

        <section id="item-2" class="section">
            <input id="item-number-2" class="item" disabled> </input>
            <button id="item-button-2" class="item">
                <span class="kode-kendaraan">MP</span>
                <img class="gambar" src="./asset/mp.png" alt="MP">
            </button>
        </section>


        <section id="item-3" class="section">
            <input id="item-number-3" class="item" disabled> </input>
            <button id="item-button-3" class="item">
                <span class="kode-kendaraan">KS</span>
                <img class="gambar" src="./asset/ks.png" alt="KS">
            </button>
        </section>

        <section id="item-4" class="section">
            <input id="item-number-4" class="item" disabled> </input>
            <button id="item-button-4" class="item">
                <span class="kode-kendaraan">BB</span>
                <img class="gambar" src="./asset/sm.png" alt="BB">
            </button>
        </section>

        <section id="item-5" class="section">
            <input id="item-number-5" class="item" disabled> </input>
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


    </main>

    <!---------------------- Modal Popup--------------------->
    <div class="modal" id="modal-data-disimpan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Data tersimpan otomatis.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> Tidak </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var isSetActive = false;

        $(document).ready(function() {

            /*------------------------------- CLICK LISTENER -------------------------------*/
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
                        reset();
                    });

                }

            });

            // SET
            $("#item-set").click(function() {
                if (isSetActive) {
                    isSetActive = false;

                    $("#item-set").css({
                        'display': 'block',
                    });

                    $("#item-stop").css({
                        'display': 'none',
                    });
                } else {
                    isSetActive = true;

                    $("#item-stop").css({
                        'display': 'block',
                    });

                    $("#item-set").css({
                        'display': 'none',
                    });
                }

            });

            // DATA
            $("#item-data").click(function() {


            });


            /*------------------------------- CLICK LISTENER -------------------------------*/


            /*------------------------------- MODAL -------------------------------*/

            function modalDataDisimpan() {
                const myModal = new bootstrap.Modal(document.getElementById('modal-data-disimpan'));
                myModal.show();
            }

            function modalTanyaReset() {
                const myModal = new bootstrap.Modal(document.getElementById('modal-tanya-reset'));
                myModal.show();
            }

            function modalTidakBisaReset() {
                const myModal = new bootstrap.Modal(document.getElementById('modal-tidak-bisa-reset'));
                myModal.show();
            }

            /*------------------------------- MODAL -------------------------------*/



            // Fungsi Reset
            function reset() {
                $("input").val(0);
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

        });
    </script>

</body>

</html>