<?php

session_start();

if (!isset($_SESSION['username'])) {
   header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PKJI Counter</title>

   <?php require_once('_layout.php'); ?>

</head>

<body>

   <main class="container">

      <div>
         <button id="btn-username" class="btn btn-danger m-2 mt-0" data-href="index.php">
            <span id="username" class="me-3"> <?= $_SESSION['username']; ?> </span> <i class="fa-solid fa-right-from-bracket"></i>
         </button>
      </div>

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
            <img class="gambar" src="./asset/bb.png" alt="BB">
         </button>
      </section>

      <section id="item-5" class="section">
         <input name="tb" id="item-number-5" class="item" disabled> </input>
         <button id="item-button-5" class="item">
            <span class="kode-kendaraan">TB</span>
            <img class="gambar" src="./asset/tb.png" alt="TB">
         </button>
      </section>


      <section id="item-6" class="align-items-start section mt-4">
         <div id="item-6-left-side" class="d-flex justify-content-center flex-column">
            <button id="item-tanggal" class="item"> </button>
            <button id="item-waktu" class="item"> </button>
         </div>
         <div id="item-6-right-side" class="w-100 d-flex justify-content-center align-items-end flex-column">

            <button id="item-set" class="btn btn-success py-2 mt-0 w-75 item">
               <i class="fa-solid fa-circle-play font-size-16 align-middle me-2"></i>Set
            </button>

            <button id="item-stop" class="btn btn-warning text-white py-2 mt-0 w-75 item">
               <i class="fa-solid fa-circle-pause font-size-16 align-middle me-2"></i> Stop
            </button>

            <button id="item-reset" class="btn btn-danger py-2 w-75 item">
               <i class="fa-regular fa-trash-can font-size-16 align-middle me-2"></i> Reset
            </button>

            <button id="item-data" class="btn btn-secondary text-white py-2 w-75 item">
               <i class="fa-solid fa-file-arrow-down font-size-16 align-middle me-2"></i> Data
            </button>
         </div>
      </section>


      <section id="item-7" class="d-flex flex-column mt-5 w-100">
         <a href="stopwatch.php">
            <button id="item-stopwatch" class="fw-bold p-1 my-1 w-100">Stopwatch <i class="fa-solid fa-up-right-from-square ms-2"></i>
            </button>
         </a>

         <a href="hambatanSamping.php">
            <button id="item-hambatan" class="fw-bold p-1 my-1 w-100">Hambatan Samping <i class="fa-solid fa-up-right-from-square ms-2"></i>
            </button>
         </a>

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


         // $(window).on('beforeunload', function() {
         //    Swal.fire({
         //       title: "<i>REFRESH</i>?",
         //       icon: "warning",
         //       showCancelButton: true,
         //       confirmButtonColor: "#3085d6",
         //       cancelButtonColor: "#d33",
         //       confirmButtonText: "Iya",
         //       cancelButtonText: "Tidak",
         //    }).then((result) => {
         //       if (result.isConfirmed) {
         //          window.location.href = 'main.php';
         //       }
         //    });
         // });

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
            reset();

            $("#item-set").css({
               'display': 'block',
            });

            $("#item-stop").css({
               'display': 'none',
            });
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


         // POP UP LOGOUT
         $("#btn-username").click(function() {

            Swal.fire({
               title: "Yakin melakukan <i>Logout</i>?",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Iya",
               cancelButtonText: "Tidak",
            }).then((result) => {
               if (result.isConfirmed) {
                  window.location.href = $(this).attr('data-href');
               }
            });

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
               'margin-top': '10px',
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
               reset();

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

            let regex = /(\d{2}):(\d{2}):(\d{2})/;

            let waktuStart = regex.exec(startInterval);
            let jamStart = parseInt(waktuStart[1]);
            let menitStart = parseInt(waktuStart[2]);
            let detikStart = parseInt(waktuStart[3]);

            let waktuEnd = regex.exec(endInterval);
            let jamEnd = parseInt(waktuEnd[1]);
            let menitEnd = parseInt(waktuEnd[2]);
            let detikEnd = parseInt(waktuEnd[3]);

            if (menitStart != menitEnd && jamStart == jamEnd) {
               let detikHitung = (60 - detikStart) + detikEnd; // 40
               let menitHitung = (menitEnd - (menitStart + 1)) * 60; // 240

               let totalDetik = detikHitung + menitHitung; // 280

               detik = totalDetik % 60; // 40 
               menit = (totalDetik - detik) / 60; // 4 
            } else if (jamStart != jamEnd) {
               let detikHitung = (60 - detikStart) + detikEnd;
               let menitHitung = ((60 - (menitStart + 1)) + menitEnd) * 60;

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
                  // console.log(xhr.responseText);

                  Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: xhr.responseText,
                  });
               }
            });

         }

      });
   </script>





   <?php

   require_once('config/database.php');

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $ambilData = new DATA();
      $ambilData->exportDataToSpreadsheet();
   }



   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $interval = $_POST['interval'];
      $durasi = $_POST['durasi'];
      $sm = $_POST['sm'];
      $mp = $_POST['mp'];
      $ks = $_POST['ks'];
      $bb = $_POST['bb'];
      $tb = $_POST['tb'];


      $user = new DATA($_SESSION['username'], $interval, $durasi, $sm, $mp, $ks, $bb, $tb);
      $user->simpanData();
      $user->exportDataToSpreadsheet();
   }

   ?>


</body>

</html>