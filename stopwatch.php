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
   <title>Stopwatch</title>

   <?php require_once('_layout.php'); ?>

</head>

<body>

   <main class="container">

      <section id="item-stopwatch" class="d-flex justify-content-center align-items-center">
         <input name="stopwatch" id="stopwatch" class="item" value="00.00,00" disabled></input>
      </section>

      <section id="item-panjang-segmen" class="d-flex justify-content-center align-items-center flex-column my-1">

         <span class="text-warning fst-italic">
            *Isi data jalan anda
         </span>
         <div class="form__group field">
            <input id="panjang-segmen" class="form__field" placeholder="Panjang Segmen (m)" value="0" required />
            <label for="panjang-segmen" class="form__label">Panjang Segmen (m)</label>

         </div>
      </section>

      <section class="section my-4">
         <div id="item-6-left-side" class="d-flex justify-content-center flex-column me-1">

            <div class="d-flex" id="m-detik" style="margin: 10px 0;">
               <input name="m-detik" class="m-0 w-100 item m-detik" value="0" disabled> </input>
               <span class="align-self-end text-white fst-italic mx-1">
                  (m/detik)
               </span>
            </div>
            <div class="d-flex" id="km-jam" style="margin: 10px 0;">
               <input name="km-jam" class="m-0 w-100 item km-jam" value="0" disabled> </input>
               <span class="align-self-end text-white fst-italic mx-1">
                  (km/jam)
               </span>
            </div>


         </div>
         <div id="item-6-right-side" class="d-flex justify-content-center align-items-end flex-column">
            <button id="item-play" class="btn btn-success startTimer reset" onclick="startTimer()">
               <div class="d-flex justify-content-center align-items-center flex-column">
                  <i class="fa-solid fa-play"></i> <span style="font-size: 12px;">Start</span>
               </div>
            </button>
            <button id="item-pause" class="btn btn-warning text-white pauseTimer reset" onclick="pauseTimer()">
               <div class="d-flex justify-content-center align-items-center flex-column">
                  <i class="fa-solid fa-pause"></i> <span style="font-size: 12px;">Pause</span>
               </div>

            </button>

            <button id="item-reset-stopwatch" class="btn btn-danger resetTimer reset" onclick="resetTimer()">
               <div class="d-flex justify-content-center align-items-center flex-column">
                  <i class="fa-solid fa-rotate-left"></i> <span style="font-size: 12px;">Reset</span>
               </div>
            </button>

         </div>
      </section>


      <section class="d-flex mb-3">
         <a id="link-download" href="form-survei-kecepatan.xlsx" class="fw-bold fst-italic">
            Download form survei
         </a>
      </section>

      <section class="d-flex flex-column">
         <button id="item-tanggal" class="w-100 item"> </button>
         <button id="item-waktu" class="w-100 item"> </button>
      </section>

      <section class="d-flex flex-column mt-5 w-100">
         <a href="main.php">
            <button id="item-stopwatch" class="fw-bold p-1 my-1 w-100">Back <i class="fa-regular fa-circle-left ms-2"></i> </button>
         </a>
      </section>
   </main>


   <div class="modal" id="modal-time-out" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body">
               <p>Interval 15 menit telah selesai, silahkan <strong> <i> mulai ulang</i></strong> ! </p>
            </div>
            <div class="modal-footer">
               <button type="button" id="modal-time-out-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
            </div>
         </div>
      </div>
   </div>


   <script>
      var startTimerButton = document.querySelector('.startTimer');
      var pauseTimerButton = document.querySelector('.pauseTimer');
      var timerDisplay = document.getElementById('stopwatch');

      var mDetikButton = document.querySelector('.m-detik');
      var kmJamButton = document.querySelector('.km-jam');
      var panjangSegmen = document.getElementById('panjang-segmen');

      var startTime;
      var updatedTime;
      var difference;
      var tInterval;
      var kInterval;
      var savedTime;
      var paused = 0;
      var running = 0;
      var milliseconds = 0;
      var startUp = true;

      var minutes = 14;
      var seconds = 60;
      var durasiInterval;

      var kecepatan = 0;

      function startTimer() {

         if (panjangSegmen.value == "0") {

            $(document).ready(function() {
               Swal.fire({
                  title: "<strong><i>Panjang Segmen</i></strong> tidak boleh nol!",
                  icon: "warning",
               })
            });
            return;
         }

         if (panjangSegmen.value == "") {

            $(document).ready(function() {
               Swal.fire({
                  title: "<strong><i>Panjang Segmen</i></strong> tidak boleh kosong!",
                  icon: "warning",
               })
            });
            return;
         }

         if (!running) {
            startTime = new Date().getTime();
            tInterval = setInterval(getShowTime, 1);
            kInterval = setInterval(getKecepatan, 500);
            paused = 0;
            running = 1;
            timerDisplay.style.cursor = 'auto';
            startTimerButton.classList.add('lighter');
            pauseTimerButton.classList.remove('lighter');
            startTimerButton.style.cursor = 'auto';
            pauseTimerButton.style.cursor = 'pointer';
         }
      }

      function pauseTimer() {
         if (!difference) {
            // if timer never started, don't allow pause button to do anything
         } else if (!paused) {
            clearInterval(tInterval);
            clearInterval(kInterval);
            savedTime = difference;
            paused = 1;
            running = 0;
            timerDisplay.style.cursor = 'pointer';
            startTimerButton.classList.remove('lighter');
            pauseTimerButton.classList.add('lighter');
            startTimerButton.style.cursor = 'pointer';
            pauseTimerButton.style.cursor = 'auto';
         } else {
            startTimer();
         }
      }

      function resetTimer() {
         clearInterval(tInterval);
         clearInterval(kInterval);
         resetKecepatan();


         savedTime = 0;
         difference = 0;
         paused = 0;
         running = 0;
         milliseconds = 0;
         timerDisplay.value = '00.00,00';
         timerDisplay.style.cursor = 'pointer';
         startTimerButton.classList.remove('lighter');
         pauseTimerButton.classList.remove('lighter');
         startTimerButton.style.cursor = 'pointer';
         pauseTimerButton.style.cursor = 'auto';
      }

      function resetKecepatan() {
         mDetikButton.value = "0";
         kmJamButton.value = "0";
      }

      function getShowTime() {

         updatedTime = new Date().getTime();
         if (savedTime) {
            difference = updatedTime - startTime + savedTime;
         } else {
            difference = updatedTime - startTime;
         }

         let hours = Math.floor(
            (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
         );
         let minutes = Math.floor(
            (difference % (1000 * 60 * 60)) / (1000 * 60)
         );
         let seconds = Math.floor((difference % (1000 * 60)) / 1000);
         let milliseconds_str;

         milliseconds = milliseconds + 1;

         hours = hours < 10 ? '0' + hours : hours;
         minutes = minutes < 10 ? '0' + minutes : minutes;
         seconds = seconds < 10 ? '0' + seconds : seconds;

         if (milliseconds >= 100) {
            milliseconds = 0;
            milliseconds_str = '00';
         } else if (milliseconds < 10) {
            milliseconds_str = '0' + milliseconds;
         } else {
            milliseconds_str = milliseconds;
         }


         timerDisplay.value = minutes + '.' + seconds + ',' + milliseconds_str;

      }

      function getKecepatan() {

         let minutes = timerDisplay.value[0] + timerDisplay.value[1];
         let seconds = timerDisplay.value[3] + timerDisplay.value[4];
         let miliseconds = timerDisplay.value[6] + timerDisplay.value[7];
         miliseconds = Number(miliseconds) / 1000;

         let jumlahDetik = Number(minutes * 60) + (Number(seconds) + miliseconds);
         mDetikButton.value = Number(Number(panjangSegmen.value) / jumlahDetik).toFixed(2);

         kmJamButton.value = Number(Number(mDetikButton.value) * 3.36).toFixed(2);
      }



      $(document).ready(function() {

         function modalInterval15Menit() {

            $('#modal-time-out').modal({
               backdrop: 'static',
               keyboard: false
            });

            $('#modal-time-out').show();

            $('#modal-time-out-tutup').click(function() {
               $('#modal-time-out').hide();
            });

         }

         $('#item-play').click(function() {

            if (startUp) {
               timeOut();
               startUp = false;
            }

            if (panjangSegmen.value == "0" || panjangSegmen.value == "") {
               return;
            }

            $("#item-pause").css({
               'display': 'block',
            });

            $("#item-play").css({
               'display': 'none',
            });
         });

         $('#item-pause').click(function() {

            $("#item-play").css({
               'display': 'block',
            });

            $("#item-pause").css({
               'display': 'none',
            });
         });

         function timeOut() {

            durasiInterval = setInterval(function() {

               seconds = seconds - 1;

               if (seconds == 0) {
                  seconds = 60;
                  minutes = minutes - 1;
               }

               let minutes_str = minutes < 10 ? '0' + minutes : minutes;

               let seconds_str = seconds < 10 ? '0' + seconds : seconds;

               timeStr = '00' + ":" + minutes_str + ":" + seconds_str;

               $("#durasi").val(timeStr);

            }, 1000);


            // // menampilkan popup ketika sudah 15 menit
            // setTimeout(function() {

            //    clearInterval(durasiInterval);
            //    modalInterval15Menit();
            //    resetTimer();
            //    minutes = 14;
            //    seconds = 60;
            //    startUp = true;

            //    $("#durasi").val("00:00:00");

            //    $("#item-play").css({
            //       'display': 'block',
            //    });

            //    $("#item-pause").css({
            //       'display': 'none',
            //    });

            // }, 15 * 60 * 1000);
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
      });
   </script>

</body>

</html>