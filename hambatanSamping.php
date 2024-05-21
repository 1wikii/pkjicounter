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

   <main class="container d-flex justify-content-center align-items-center">

      <div class="w-75 bg-success text-white text-center fst-italic fs-5 rounded py-3 px-4 mt-5">
         Bagian ini masih dalam tahap pengembangan
      </div>

      <section class="d-flex flex-column mt-5 w-100">
         <a href="main.php">
            <button id="item-stopwatch" class="fw-bold p-1 my-1 w-100">Back <i class="fa-regular fa-circle-left ms-2"></i>
            </button>
         </a>

      </section>
   </main>

</body>

</html>