<?php
include '../php/koneksi.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
  header('location:../php/login.php');
  exit;
}

$user_id = $_SESSION['user_id']; // Define $user_id here

// Handle form submission
if (isset($_POST['order_btn'])) {
  // Sanitize input data
  $nama = mysqli_real_escape_string($con, $_POST['nama']);
  $no_tlpn = mysqli_real_escape_string($con, $_POST['no_tlpn']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $method = mysqli_real_escape_string($con, $_POST['method']);
  $address = mysqli_real_escape_string($con, $_POST['alamat']);

  // Validate input data
  $errors = [];
  if (empty($nama) || empty($no_tlpn) || empty($email) || empty($method) || empty($address)) {
    $errors[] = 'All fields are required.';
  }
  
  // Proceed with order if there are no errors
  if (empty($errors)) {
    $tgl_transaksi = date('d-M-Y');
    $cart_total = 0;
    $cart_events = [];
    
    // Calculate total price and get list of events in cart
    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('Query failed');
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
      $sub_total = $fetch_cart['harga_events'] * $fetch_cart['jumlah_events'];
      $cart_total += $sub_total;
      $cart_events[] = $fetch_cart['nama'] . ' (' . $fetch_cart['jumlah_events'] . ')';
    }
    $total_events = implode(', ', $cart_events);
    
    // Insert transaction into database using prepared statement
    $insert_query = "INSERT INTO `transaksi` (id_user, nama, no_tlpn, email, metode_pembayaran, alamat, total_events, total_harga, tgl_transaksi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssssssids", $user_id, $nama, $no_tlpn, $email, $method, $address, $total_events, $cart_total, $tgl_transaksi);

    if (mysqli_stmt_execute($stmt)) {
      // Clear cart after successful transaction
      mysqli_query($con, "DELETE FROM `cart` WHERE id_user = '$user_id'") or die('Query failed');
      $message[] = 'Transaction successful!';
    } else {
      $errors[] = 'Failed to process transaction.';
    }
    mysqli_stmt_close($stmt);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | TorajaFest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <?php include('../view/header-footer/header.php') ?>

  <section class="shadow rounded m-5">
    <h2 class="text-center fs-4 m-4 p-3 fw-medium">Let's Go Checkout</h2>
    <div class="d-flex justify-content-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none fw-light fs-6" style="color: #19376d;">Home</a></li>
        <li class="breadcrumb-item active text-decoration-none fw-ligy fs-6" aria-current="page">Checkout</li>
      </ol>
    </div>
  </section>

  </div>
  <section class="d-flex align-items-center">
    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('Query failed');
    if (mysqli_num_rows($select_cart) > 0) {
      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $total_harga = $fetch_cart['harga_events'] * $fetch_cart['jumlah_events'];
        $grand_total += $total_harga;
    ?>
        <p><?php echo $fetch_cart['nama']; ?> <span>(<?php echo 'Rp' . $fetch_cart['harga_events'] . '/-' . ' x ' . $fetch_cart['jumlah_events']; ?>)</span></p>
    <?php
      }
    } else {
      echo '<p class="empty">Your cart is empty</p>';
    }
    ?>
  </section>

  <div class="grand-total"> Grand total: <span>Rp <?php echo $grand_total; ?>/-</span></div>

  <section class="d-flex justify-content-center">
    <form action="" method="post" class="p-5 shadow rounded">
      <h3 class="text-center fs-2 p-3">Fill in Identity Data</h3>
      <div class="flex">
        <div class="">
          <span>Name</span>
          <input type="text" name="nama" required placeholder="Your name" class="form-control">
        </div>
        <div class="inputBox">
          <span>Email</span>
          <input type="email" name="email" required placeholder="Your email" class="form-control">
        </div>
        <div class="inputBox">
          <span>Phone Number</span>
          <input type="number" name="no_tlpn" required placeholder="Your number" class="form-control">
        </div>
        <div class="inputBox">
          <span>Payment Method</span>
          <select name="method" class="form-control">
            <option value="Cash on delivery">Cash on delivery</option>
          </select>
        </div>
        <div class="inputBox">
          <span>Address</span>
          <input type="text" min="0" name="alamat" required placeholder="Complete Address" class="form-control">
        </div>
        <div class="inputBox">
          <span>Postal Code</span>
          <input type="number" min="0" name="kode_pos" required placeholder="0000" class="form-control">
        </div>
      </div>
      <input type="submit" value="Order now" class="btn btn-outline-dark form-control" name="order_btn">
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
