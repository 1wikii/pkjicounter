<?php

session_start();

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link rel="shortcut icon" href="./asset/traffic.png">

    <!-- Framework dan stack lain -->
    <script src="https://kit.fontawesome.com/c2b7ee3658.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="index.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;

            color: white;

            height: 100vh;
        }

        input {
            font-size: 1.2em;
        }
    </style>

</head>

<body>


    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="container">


        <div class="mb-3">
            <label for="username" class="form-label">Username</label>

            <input id="username" name="username" type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>

            <input id="password" name="password" type="password" class="form-control" required>
        </div>
        <div class="ms-3 mb-3 form-check">

            <input id="show" type="checkbox" class="form-check-input">
            <label class="form-check-label">show</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary fs-3">Log In</button>
    </form>



    <div class="modal" id="modal-login-gagal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <p class="text-danger fs-5"><strong> <i> Login gagal! </i></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-login-gagal-tutup" class="btn btn-primary" data-bs-dismiss="modal"> Tutup </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $('#show').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });


            function modalLoginGagal() {

                $('#modal-login-gagal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modal-login-gagal').show();

                $('#modal-login-gagal-tutup').click(function() {
                    $('#modal-login-gagal').hide();
                });

            }

            <?php if (isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] == 'salah') : ?>
                modalLoginGagal();
            <?php endif; ?>

        });
    </script>


    <?php

    require_once('config/database.php');
    // echo "<p style='color: red;'>" . "HALOO INI MUNCULL GASKKK" . "</p>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user = new DATA();
        $_SESSION['loginStatus'] = $user->login($_POST['username'], $_POST['password']);


        if ($_SESSION['loginStatus'] == 'benar') {
            unset($_SESSION['loginStatus']);
            header("Location: main.php");
        } else {
            header("Location: index.php");
        }
    }

    ?>

</body>

</html>