<?php

include 'koneksi.php';

session_start();
$user_id = $_SESSION['admin_id'];

if (!isset($user_id)) {
  header('location:login.php');
}


if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM `rate_view` WHERE id_rate = '$delete_id'") or die('query gagal');
  header('location:admin-message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Users</title>

  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .box {
      border: 1px solid #ccc;
      padding: 20px;
      margin: 10px auto; /* Vertically centered */
      max-width: 600px; /* Maximum width of the box */
    }

    @media (max-width: 576px) {
      .box {
        width: calc(100% - 20px); /* Box will occupy full width on smaller screens */
      }
    }
  </style>
</head>

<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center">FEEDBACK</h1>
  <section>
    <div class="container">
      <div class="row justify-content-center">
        <?php
        $select_message = mysqli_query($con, "SELECT * FROM `rate_view`") or die('query failed');
        if (mysqli_num_rows($select_message) > 0) {
          while ($fetch_message = mysqli_fetch_assoc($select_message)) {
        ?>
            <div class="col-12">
              <div class="box mx-auto"> <!-- Centered horizontally -->
                <p> User id : <span><?php echo $fetch_message['id_user']; ?></span> </p>
                <p> Name : <span><?php echo $fetch_message['nama']; ?></span> </p>
                <p> Number : <span><?php echo $fetch_message['no_tlpn']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
                <p> Feedback : <span><?php echo $fetch_message['komentar']; ?></span> </p>
                <a href="admin-message.php?delete=<?php echo $fetch_message['id_rate']; ?>" onclick="return confirm('Delete this feedback?');" class="delete-btn">Delete feedback</a>
              </div>
            </div>
        <?php
          };
        } else {
          echo '<p class="empty text-center">You haven\'t received any feedbacks from customers yet!</p>';
        }
        ?>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
