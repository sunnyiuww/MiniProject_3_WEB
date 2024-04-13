<?php
session_start();

include 'koneksi.php';

$message = []; // Initialize an empty array to store error messages

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['cpassword']) || empty($_POST['no_tlpn']) || empty($_POST['jenis_kelamin']) || empty($_POST['user_type'])) {
        $message[] = 'All fields are required!';
    } else {
        $nama = mysqli_real_escape_string($con, $_POST['nama']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = mysqli_real_escape_string($con, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
        $no_tlpn = mysqli_real_escape_string($con, $_POST['no_tlpn']);
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $user_type = $_POST['user_type'];

        $select_user = mysqli_query($con, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if (mysqli_num_rows($select_user) > 0) {
            $message[] = 'Account already exists!';
        } else {
            if ($pass != $cpass) {
                $message[] = 'Passwords do not match!';
            } else {
                mysqli_query($con, "INSERT INTO `user`(nama, email, password, no_tlpn, user_type, jenis_kelamin) VALUES('$nama', '$email', '$cpass','$no_tlpn', '$user_type', '$jenis_kelamin')") or die('query failed');
                $message[] = 'Registered successfully!';
            }
        }
    }
}

// Clear session after form submission
unset($_SESSION['nama']);
unset($_SESSION['email']);
unset($_SESSION['no_tlpn']);
unset($_SESSION['jenis_kelamin']);
unset($_SESSION['user_type']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TorajaFest</title>
    <!--CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            background-color: whitesmoke;
        }

        .container {
            min-height: 80vh;
            width: 500px; /* Sesuaikan lebar sesuai kebutuhan */
        }

        .card-body {
            background-color: white;
            height: auto;
        }

        input[type="submit"] {
            background-color: #19376d;
        }

        input[type="submit"]:hover {
            background-color: #205295;
        }

        #alert {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 300px; /* Sesuaikan lebar sesuai kebutuhan */
            font-size: 1rem; /* Sesuaikan ukuran font sesuai kebutuhan */
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <form class="border shadow p-3 rounded m-2" action="" method="post" style="background:white; width: 100%;">
            <h1 class="text-center">REGISTER</h1>

            <?php
            if (!empty($message)) {
                foreach ($message as $msg) {
                    if ($msg == 'Registered successfully!') {
                        echo '<div id="alert" class="alert alert-primary" role="alert">';
                        echo '<strong>' . $msg . '</strong>';
                        echo '<br>Redirecting to login page in <span id="countdown">3</span> seconds.';
                        echo '</div>';
                    } else {
                        echo '
                        <div id="alert" class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>' . $msg . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }
                }
            }
            ?>

            <div class="col-mb-2">
                <label for="nama" class="form-label">Full name</label>
                <input type="nama" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="col-mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="col-mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <label for="password" class="form-label">Re-Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters
                    </span>
                </div>
            </div>
            <div class="col-mb-1">
                <label for="inputtelp" class="form-label">Phone Number</label>
                <input type="number" name="no_tlpn" class="form-control" id="inputtelp" required>
            </div>
            <div class="col-mb-2">
                <label for="inputState" class="form-label">Gender</label>
                <select name="jenis_kelamin" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Please select</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>

            <div class="col-mb-2">
                <label for="inputState" class="form-label">Role</label>
                <select name="user_type" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Please select</option>
                    <option value="admin">Admin</option>
                    <option value="costumer">Customer</option>
                </select>
                <br>
            </div>

            <div class="d-grid gap-2">
                <input class="btn btn-primary" name="submit" type="submit" value="Register">
            </div>

            <div class="text-center">
                <p>Already have an account? <a href="login.php" class="text-decoration-none">Login Here</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var countdown = document.getElementById('countdown');
            var seconds = 3;
            var timer = setInterval(function() {
                seconds--;
                countdown.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.href = 'login.php';
                }
            }, 1000);
        });
    </script>
</body>

</html>
