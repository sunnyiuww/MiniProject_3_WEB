<?php


include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, md5($_POST['password']));

  $select_user = mysqli_query($con, "SELECT * FROM  `user` WHERE email = '$email' AND password = '$password'") or die('query failed');
  if (mysqli_num_rows($select_user) > 0) {

    $row = mysqli_fetch_assoc($select_user);

    if ($row['user_type'] == 'admin') {

      $_SESSION['admin_nama'] = $row['nama'];
      $_SESSION['admin_email'] = $row['email'];
      $_SESSION['admin_id'] = $row['id_user'];
      header('location: ../view/adminpages/admin-home.php');
    } elseif ($row['user_type'] == 'costumer') {

      $_SESSION['user_nama'] = $row['nama'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_id'] = $row['id_user'];
      header('location:../view/home.php');
    }
  } else {
    $message[] = 'Wrong Email or Password!';
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!--CDN-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- custom css file link  -->


</head>
<style>
  ::-webkit-scrollbar {
    display: none;
  }

  body {
    background-color: whitesmoke;
  }

  .container {
    min-height: 80vh;
    width: 500px;
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

  .alert {
    position: fixed;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 300px; /* Sesuaikan lebar sesuai kebutuhan */
    font-size: 1rem; /* Sesuaikan ukuran font sesuai kebutuhan */
  }

</style>

<body>

<?php
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>' . $msg . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }
    ?>


  <div class="container d-flex justify-content-center align-items-center">
    <div class="card-body border shadow p-3 rounded m-2">
      <form action="" method="post">
        <h1 class="text-center pb-4">LOGIN</h1>
        <!-- email -->
        <div class="col-mb-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" placeholder="Please enter your email" required class="form-control">
        </div>

        <!-- pass -->
        <div class="col-mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" placeholder="Please enter your password" required class="form-control">
          <div class="col-auto">
            <span id="passwordHelpInline" class="form-text">
            Must be 8-20 characters
            </span>
          </div>
          <br>
        </div>

        <!-- <div class="col-mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Apakah sudah lengkap?
            </label>
          </div>
        </div> -->
        <!-- btn -->
        <div class="d-grid gap-2">
          <input type="submit" name="submit" value="Login" class="btn text-white">
          <div class="text-center">
            <p>Don't have an account yet? <a href="register.php" class="text-decoration-none">Register here</a></p>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>