<?php

include '../php/koneksi.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:../php/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Search | TorajaFest</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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
      gap: 3rem;
      background: url(../assets/img/searchh.jpg) no-repeat;
      background-size: 100%;
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
  </style>
</head>

<body>

  <?php include('./header-footer/header.php') ?>
  <div class="headings">
    <h1 class=" text-white fs-1 fw-bold text-uppercase ">TorajaFest Cart</h1>
    <div class="pags rounded" aria-label="breadcrumb">
      <ol class="breadcrumb ">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fs-bold fs-5 ">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fs-bold fs-5" aria-current="page">Cart</li>
      </ol>
    </div>
  </div>

  <section class="d-flex justify-content-center">
    <form action="" method="post" class="row m-4">
      <input class="form-control border border-secondary " type="text" name="search" placeholder="Search event">
      <input type="submit" name="submit" value="Search" class="btn btn-secondary">
    </form>
  </section>

  <section class="d-flex justify-content-center ">
    <div class="container-fluid" style="min-width: 30vh;">
      <?php
      if (isset($_POST['submit'])) {
        $search_item = $_POST['search'];
        $select_events = mysqli_query($con, "SELECT * FROM `events` WHERE nama_events LIKE '%{$search_item}%'") or die('query failed');
        if (mysqli_num_rows($select_events) > 0) {
          while ($fetch_event = mysqli_fetch_assoc($select_events)) {
      ?>
            <div class="shadow rounded m-3 border border-3 border-dark text-center fw-bold ">
              <img src="uploaded_img/<?php echo $fetch_event['image']; ?>" alt="" class="image">
              <div class="nama"><?php echo $fetch_event['nama_events']; ?></div>
              <!-- <div class="price"> Rp <?php echo $fetch_event['harga_events']; ?> /-</div> -->
              <div class="description"><?php echo $fetch_event['deskripsi_event']; ?></div>
            </div>
      <?php
          }
        } else {
          echo '<p class="empty">No event found!</p>';
        }
      } 
      ?>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
