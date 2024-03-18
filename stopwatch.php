<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Stopwatch</title>

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

      <section id="item-stopwatch" class="">
         <input name="stopwatch" id="stopwatch" class="item" value="00:00:00:00" disabled></input>
      </section>

      <!-- <section id="item-durasi" class="">
         <input name="durasi" id="durasi" class="item" value="00:00:00" disabled> </input>
      </section> -->

      <section id="item-6" class="section">
         <div id="item-6-left-side">
            <button id="item-tanggal" class="item"> </button>
            <button id="item-waktu" class="item"> </button>
         </div>
         <div id="item-6-right-side">
            <button id="item-play" class="startTimer reset" onclick="startTimer()"> <i class="fas fa-play"></i> </button>
            <button id="item-pause" class="pauseTimer reset" onclick="pauseTimer()"> <i class="fas fa-pause"></i> </button>

            <button id="item-reset-stopwatch" class="resetTimer reset" onclick="resetTimer()"> <i class="fa-solid fa-clock-rotate-left"></i> </button>

            <!-- <button id="item-data" class="item"> Data </button> -->
         </div>
      </section>

      <section id="item-5" class="d-flex justify-content-center align-items-center mt-5">
         <a href="main.php"><button id="item-stopwatch"> Back <i class="fa-regular fa-circle-left"></i> </button></a>
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
      var startTime;
      var updatedTime;
      var difference;
      var tInterval;
      var savedTime;
      var paused = 0;
      var running = 0;
      var milliseconds = 0;
      var startUp = true;

      var minutes = 14;
      var seconds = 60;
      var durasiInterval;

      function startTimer() {
         if (!running) {
            startTime = new Date().getTime();
            tInterval = setInterval(getShowTime, 1);
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
         savedTime = 0;
         difference = 0;
         paused = 0;
         running = 0;
         milliseconds = 0;
         timerDisplay.value = '00:00:00:00';
         timerDisplay.style.cursor = 'pointer';
         startTimerButton.classList.remove('lighter');
         pauseTimerButton.classList.remove('lighter');
         startTimerButton.style.cursor = 'pointer';
         pauseTimerButton.style.cursor = 'auto';
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


         timerDisplay.value =
            hours + ':' + minutes + ':' + seconds + ':' + milliseconds_str;
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

               // if(){

               // }
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
            });

         }

         // Update jam-menit-detik setiap detik
         setInterval(updateClock, 1000);
      });
   </script>

</body>

</html>