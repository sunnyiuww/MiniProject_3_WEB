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
   <title>Booking | TorajaFest</title>

   <!-- CDN -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
   <?php include('./header-footer/header.php') ?>

   <section class="container-lg border border-3">
      <div class="d-flex justify-content-center">
         <?php
         $trns_query = mysqli_query($con, "SELECT * FROM `transaksi` WHERE id_user = '$user_id'") or die('query gagal;');
         if (mysqli_num_rows($trns_query) > 0) {
            while ($fetch_trns = mysqli_fetch_assoc($trns_query)) {
               // Mengambil ID transaksi
               $transaksi_id = $fetch_trns['id_transaksi'];

               // Menghitung total event yang di checkout
               $total_event = 0;
               $detail_query = mysqli_query($con, "SELECT COUNT(*) AS total_event FROM `transaksi` WHERE id_transaksi = '$transaksi_id'");
               if ($detail_query) {
                  $fetch_detail = mysqli_fetch_assoc($detail_query);
                  $total_event = $fetch_detail['total_event'];
               }
         ?>
               <div class="form-control">
                  <p> Tanggal Transaksi : <span><?php echo $fetch_trns['tgl_transaksi']; ?></span> </p>
                  <p> Name : <span><?php echo $fetch_trns['nama']; ?></span> </p>
                  <p> Number : <span><?php echo $fetch_trns['no_tlpn']; ?></span> </p>
                  <p> Email : <span><?php echo $fetch_trns['email']; ?></span> </p>
                  <p> Address : <span><?php echo $fetch_trns['alamat']; ?></span> </p>
                  <p> Payment method : <span><?php echo $fetch_trns['metode_pembayaran']; ?></span> </p>
                  <p> Your orders : <span><?php echo $total_event; ?></span> </p>
                  <p> Total price : <span>Rp<?php echo $fetch_trns['total_harga']; ?>/-</span> </p>
                  <p> Payment status : <span style="color:<?php echo ($fetch_trns['status_pembayaran'] == 'pending') ? 'red' : 'green'; ?>"><?php echo $fetch_trns['status_pembayaran']; ?></span> </p>
                  <a href="../php/invoice.php"><button class="btn btn-secondary" type="submit">Print</button> </a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No orders placed yet!</p>';
         }
         ?>
      </div>
      </div>
   </section>


   <?php include('./header-footer/footer.php') ?>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
