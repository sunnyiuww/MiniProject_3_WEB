<?php

include '../php/koneksi.php';
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header('location:../php/login.php');
  exit; // Pastikan untuk keluar dari skrip setelah mengarahkan pengguna ke halaman login
}

$user_id = $_SESSION['user_id'];

// Periksa apakah tombol add_cart telah diklik
if (isset($_POST['add_cart'])) {
  
  // Ambil nilai dari formulir
  $nama  = $_POST['nama_events'];
  $harga_events = $_POST['harga_events'];
  $image = $_POST['image'];
  $jumlah_events = $_POST['jumlah_events'];

  // Persiapkan dan jalankan prepared statement untuk memeriksa apakah item sudah ada di cart
  $stmt_check_cart = $con->prepare("SELECT * FROM `cart` WHERE nama = ? AND id_user = ?");
  $stmt_check_cart->bind_param("si", $nama, $user_id);
  $stmt_check_cart->execute();
  $result_check_cart = $stmt_check_cart->get_result();

  // Jika item sudah ada di cart, tampilkan pesan
  if ($result_check_cart->num_rows > 0) {
    $message[] = 'Event is already in the cart!';
  } else {
    // Persiapkan dan jalankan prepared statement untuk menambahkan item ke cart
    $stmt_add_cart = $con->prepare("INSERT INTO `cart`(id_user, nama, harga_events, jumlah_events, image) VALUES(?, ?, ?, ?, ?)");
    $stmt_add_cart->bind_param("isdis", $user_id, $nama, $harga_events, $jumlah_events, $image);
    $stmt_add_cart->execute();
    $message[] = 'Event added to cart!';
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events | TorajaFest</title>
  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,200&display=swap");

  * {
    font-family: "Poppins", sans-serif;
  }

  .headings {
    min-height: 40vh;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    background: url(../assets//img/event.png) no-repeat;
    background-size: cover;
    background-position: center;
    text-align: center;

  }

  .pags {

    min-width: 10vh;
    height: 30px;
    padding: 3px 3px 3px;
    background-color: #EEEEEE;

  }

  a {
    color: #19376d;
  }

  a:hover {
    color: black;
  }

  .event-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px; /* Spasi antara kotak event */
  }

  .event-box {
    flex: 0 0 calc(33.33% - 20px); /* Lebar kotak event 33.33% dari lebar kontainer */
    background-color: white;
    border: 1px solid #ced4da;
    border-radius: 5px;
    overflow: hidden;
  }

  .event-box img {
    width: 100%;
    height: auto;
  }

  .event-info {
    padding: 10px;
  }

  .event-info .name {
    font-weight: bold;
  }

  .event-info .price {
    color: #007bff;
  }
</style>

<body>
  <?php include('./header-footer/header.php') ?>
  <div class="headings">
    <h1 class="text-white fs-1 fw-bolder text-uppercase">Latest Events</h1>
    <div class="pags rounded" aria-label="breadcrumb">
      <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fs-bold fs-5">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fs-bold fs-5" aria-current="page">Events</li>
      </ol>
    </div>

  </div>
  <div class="event-container">
    <?php
    $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query gagal');
    if (mysqli_num_rows($select_events) > 0) {
      while ($fetch_events = mysqli_fetch_assoc($select_events)) {
    ?>
        <div class="event-box">
          <form action="" method="post" class="text-center">
            <img class="image" src="uploaded_img/<?php echo $fetch_events['image']; ?>" alt="" style="width: 250px;">
            <div class="event-info">
              <div class="name"><?php echo $fetch_events['nama_events']; ?></div>
              <div class="price">Rp <?php echo $fetch_events['harga_events']; ?>/-</div>
              <input type="number" min="1" name="jumlah_events" value="1" class="qty">
              <input type="hidden" name="nama_events" value="<?php echo $fetch_events['nama_events']; ?>">
              <input type="hidden" name="harga_events" value="<?php echo $fetch_events['harga_events']; ?>">
              <input type="hidden" name="image" style="width: 500px;" value="<?php echo $fetch_events['image']; ?>">
              <input type="submit" value="Add to cart" name="add_cart" class="btn btn-secondary m-2">
            </div>
          </form>
        </div>
    <?php
      }
    } else {
      echo '<p class="empty">No Events Yet!</p>';
    }
    ?>
  </div>

  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
