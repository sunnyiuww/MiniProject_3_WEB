<?php

include 'koneksi.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

$message = []; // Inisialisasi variabel pesan sebagai array

if (isset($_POST['send'])) {
  $nama = mysqli_real_escape_string($con, $_POST['nama']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $tlpn = $_POST['no_tlpn'];
  $msg = mysqli_real_escape_string($con, $_POST['komentar']);

  // Periksa apakah feedback sudah pernah dikirim sebelumnya
  $select_message = mysqli_query($con, "SELECT * FROM `rate_view` WHERE nama = '$nama' AND email = '$email' AND no_tlpn = '$tlpn' AND komentar = '$msg'");
  if (mysqli_num_rows($select_message) > 0) {
    $message[] = 'Feedback has already been sent!';
  } else {
    // Insert feedback ke dalam database
    $insert_query = mysqli_query($con, "INSERT INTO `rate_view` (id_user, nama, email, no_tlpn, komentar) VALUES ('$user_id', '$nama', '$email', '$tlpn', '$msg')");
    if ($insert_query) {
      $message[] = 'Feedback sent successfully!';
    } else {
      $message[] = 'Failed to send feedback!';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback | TorajaFest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    /* Adding some custom styles for spacing */
    .mb-4-custom {
      margin-bottom: 1.5rem; /* Adjust the spacing as needed */
    }
  </style>
</head>

<body>
  <?php include('header.php') ?>

  <main class="container-fluid">
    <section class="shadow rounded m-5" style="background-color: #19376d;">
      <h2 class="text-center fs-4 m-4 p-3 fw-medium text-white">Feedback</h2>
      <div class="d-flex justify-content-center bg-white">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
          <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">Feedback</li>
        </ol>
      </div>
    </section>
    <section class="shadow rounded m-5 p-4 border border-3" style="background-color: #19376d;">
      <div class="d-flex justify-content-center">
        <form action="" method="post" class="p-4">
          <h3 class="text-center text-capitalize text-white fw-bold p-2 fs-2">Fill In Here!</h3>
          <div class="mb-4-custom">
            <input type="text" class="form-control mb-3" name="nama" placeholder="Your name" required>
            <input type="email" class="form-control mb-3" name="email" placeholder="Your email" required>
            <input type="tel" class="form-control mb-3" name="no_tlpn" placeholder="Your Phone Number" required>
            <textarea name="komentar" class="form-control mb-3" placeholder="Your feedback" cols="30" rows="10" required></textarea>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <input type="submit" value="Send feedback" name="send" class="btn btn-outline-light form-control">
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
  <?php include('footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
