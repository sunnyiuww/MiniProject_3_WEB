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
  <title>About | TorajaFest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <?php include('./header-footer/header.php') ?>
  <main class="container-lg ">

    <h2 class="text-center fs-1 m-4 fw-medium" style="color: #19376d;">ABOUT FESTIVAL</h2>
    <div class="m-3 d-flex justify-content-center">
      <ol class=" breadcrumb">
        <li class="breadcrumb-item "><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">About</li>
      </ol>
    </div>

    <section class="m-5">
    <div class="container p-3">
    <div class="d-flex justify-content-center">
        <video muted autoplay loop width="2400" height="450">
            <source src="../assets/img/about.mp4" type="video/mp4">
        </video>
    </div>
    </div>
        <h1 class="text-center m-3">What is the Toraja In Art and Culture Festival?</h1>
        <p class="text-center"> Toraja In Art and Culture Festival is a vibrant celebration aimed at showcasing the rich tapestry of Torajan arts and culture. It serves as a poignant reminder of the timeless traditions and profound heritage deeply rooted in the Toraja community. This festival acts as a beacon, drawing together artisans, performers, and cultural enthusiasts from far and wide to immerse themselves in the captivating essence of Torajan culture.

        <br>At the heart of this festival lies a profound commitment to preserving and promoting the unique artistic expressions and cultural practices of the Toraja people. Through a diverse array of events and activities, ranging from mesmerizing traditional performances to insightful workshops and exhibitions, the festival offers a multifaceted exploration of Torajan artistry and cultural heritage.

        <br>Moreover, "Toraja In Art and Culture Festival" serves as a platform for cultural exchange and dialogue, fostering connections between Toraja's rich heritage and contemporary society. It invites visitors to delve into the intricacies of Torajan customs, rituals, and belief systems, offering a deeper understanding of the cultural fabric that binds the Toraja community together.

        <br>In essence, this festival transcends mere entertainment; it embodies a profound journey of discovery, enlightenment, and appreciation for the timeless beauty and significance of Torajan arts and culture.
        </p>
      </div>
    </section>
    <section class="m-5">
      <div class="container" style="min-height: 30vh;">
        <h1 class="text-center fw-medium">Partnership</h1>
        <div class="row row-cols-2  row-cols-lg-5 g-2 g-lg-3 m-3 d-flex justify-content-center">
          <div class="col">
            <img src="../assets/img/logo1.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo2.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo3.png" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo4.png" width="180px" height="180px" class="rounded-circle">
          </div>
        </div>
        <div class="row row-cols-2  row-cols-lg-5 g-2 g-lg-3 m-3 d-flex justify-content-center">
          <div class="col">
            <img src="../assets/img/logo5.png" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo6.png" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo7.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
          <div class="col">
            <img src="../assets/img/logo8.jpg" width="180px" height="180px" class="rounded-circle">
          </div>
        </div>
    </section>
    <section class="m-5">
      <h1 class="text-center m-4">Team Project</h1>
      <div class="row row-cols-1  row-cols-lg-6 d-flex justify-content-center align-items-center" style="min-height: 30vh;">
        <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/img.jpeg" class="card-img-top p-2" alt="Trio Tahril Rifandi">
          <div class="card-body text-center">
            <p class="card-text">Rizani Rupa' Mdaun</p>
            <p class="card-text">2209116039</p>
            <p class="card-text">Information System 2022</p>
          </div>
        </div>
        <!-- <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/banner-search.png" class="card-img-top p-4" alt="Lina Mulia Sari">
          <div class="card-body text-center">
            <p class="card-text">Lina Mulia Sari</p>
            <p class="card-text">Informatika</p>
          </div>
        </div>
        <div class="col card shadow m-3" style="width: 18rem;">
          <img src="../assets/img/banner-search.png" class="card-img-top p-4" alt="Trio Tahril Rifandi">
          <div class="card-body text-center">
            <p class="card-text">Rijaldi</p>
            <p class="card-text">Informatika</p>
          </div> -->
        </div>
      </div>
    </section>
  </main>


  <?php include('./header-footer/footer.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>