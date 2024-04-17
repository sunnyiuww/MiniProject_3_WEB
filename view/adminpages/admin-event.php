<?php
// admin-event.php

include 'koneksi.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:login.php');
};

if (isset($_POST['add_events'])) {
  $nama = mysqli_real_escape_string($con, $_POST['nama_events']);
  $harga = $_POST['harga_events'];
  $deskripsi = $_POST['deskripsi_event'];
  $image_name = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_size = $_FILES['image']['size'];
  $image_folder = 'uploaded_img/' . $image_name;

  // Cek apakah nama event sudah ada dalam database
  $select_events_name = mysqli_query($con, "SELECT nama_events FROM `events` WHERE nama_events = '$nama'") or die('query failed');

  if (mysqli_num_rows($select_events_name) > 0) {
    $message[] = 'Event Name Already Exists';
  } else {
    // Memindahkan gambar yang diunggah ke folder yang ditentukan
    move_uploaded_file($image_tmp_name, $image_folder);

    // Menambahkan event ke database
    $add_event_query = mysqli_query($con, "INSERT INTO `events`(nama_events, harga_events, deskripsi_event, image) VALUES('$nama', '$harga','$deskripsi', '$image_name')") or die('query failed');

    if ($add_event_query) {
      $message[] = 'Event Successfully Added!';
    } else {
      $message[] = 'Events Cannot Be Added Yet!';
    }
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];

  // Menghapus gambar terkait dari folder uploaded_img
  $delete_image_query = mysqli_query($con, "SELECT image FROM `events` WHERE id_events = '$delete_id'") or die('query gagal');
  $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
  unlink('../uploaded_img/' . $fetch_delete_image['image']);

  // Menghapus event dari database
  mysqli_query($con, "DELETE FROM `events` WHERE id_events = '$delete_id'") or die('query gagal');

  header('location:admin-event.php');
}

if (isset($_POST['update_events'])) {
  $update_p_id = $_POST['update_p_id'];
  $update_nama = $_POST['update_nama'];
  $update_harga = $_POST['update_harga'];
  $deskripsi = $_POST['deskripsi_event'];

  // Prepare statement for updating event
  $stmt = $con->prepare("UPDATE `events` SET nama_events = ?, harga_events = ?, deskripsi_event = ? WHERE id_events = ?");
  $stmt->bind_param("sdsi", $update_nama, $update_harga, $deskripsi, $update_p_id);

  // Execute the prepared statement
  if ($stmt->execute()) {
    // Update successful
    header('location:admin-event.php');
  } else {
    // Handle error
    echo "Error: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events </title>
  <!-- CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <?php include('admin-header.php') ?>

  <h1 class="text-center m-5">EVENTS</h1>

  <!-- Form tambah event -->
  <section class="container-fluid d-flex justify-content-center">
    <div class="shadow p-3 m-3 rounded border border-4 border border-secondary" style=" width: 700px;">
      <form action="" method="post" enctype="multipart/form-data">
        <h3 class="text-center m-3">Add Event</h3>
        <div class="m-3">
          <input type="text" name="nama_events" class="form-control border border-secondary" placeholder="Event Name" required>
        </div>
        <div class="m-3">
          <input type="number" min="0" name="harga_events" class="form-control border border-secondary" placeholder="Event Price" required>
        </div>
        <div class="m-3">
          <textarea type="text" name="deskripsi_event" class="form-control border border-secondary" placeholder="Description" required></textarea>
        </div>
        <div class="m-3">
          <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="form-control border border-secondary" required>
        </div>
        <div class="m-3">
          <input type="submit" value="Add events" name="add_events" class="btn btn-outline-secondary form-control">
        </div>
      </form>
    </div>
  </section>

  <!-- Form update event -->
  <section class="container-fluid d-flex justify-content-center">
    <div class="shadow p-3 m-3 rounded  border border-secondary border-4" style="width: 700px;">
      <?php
      if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($con, "SELECT * FROM `events` WHERE id_events = '$update_id'") or die('query gagal');
        if (mysqli_num_rows($update_query) > 0) {
          while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id_events']; ?>">
              <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
              <img src="../uploaded_img/<?php echo $fetch_update['image']; ?>" alt="" class="img-fluid" style="width: 400px;">

              <div class="m-3">
                <input type="text" name="update_nama" value="<?php echo $fetch_update['nama_events']; ?>" class="form-control border border-secondary" required placeholder="Masukan Nama Event">
              </div>
              <div class="m-3">
                <input type="number" name="update_harga" value="<?php echo $fetch_update['harga_events']; ?>" min="0" class="form-control border border-secondary" required placeholder="Masukan Harga Events">
              </div>
              <div class="m-3">
                <input type="text" name="deskripsi_event" value="<?php echo $fetch_update['deskripsi_event']; ?>" min="0" class="form-control border border-secondary" required placeholder="Masukan deskripsi Events">
              </div>
              <div class="m-3">
                <input type="file" class="form-control border border-secondary" name="update_image" accept="image/jpg, image/jpeg, image/png">
              </div>
              <div class="m-3">
                <input type="submit" value="Update" name="update_events" class="btn btn-outline-secondary">
                <input type="reset" value="Cancel" onclick="window.history.back();" class="btn btn-outline-secondary">
              </div>
            </form>
      <?php
          }
        }
      }
      ?>
    </div>
  </section>

  <!-- Tampilan Events -->
  <section class="container-fluid d-flex justify-content-center">
    <div class="shadow p-3 m-3 border border-4  border border-secondary  rounded text-center" style="width: 700px;">
      <h3 class="m-3">Existing Events</h3>
      <?php
      $select_events = mysqli_query($con, "SELECT * FROM `events`") or die('query gagal');
      if (mysqli_num_rows($select_events) > 0) {
        while ($fetch_events = mysqli_fetch_assoc($select_events)) {
      ?>
          <div class=" border border-secondary m-4 ">
            <img src="../uploaded_img/<?php echo $fetch_events['image']; ?>" alt="" class="img-fluid" style="width: 500px;">
            <div class="nama_events"><?php echo $fetch_events['nama_events']; ?></div>
            <div class="harga_events">Rp <?php echo $fetch_events['harga_events']; ?> /-</div>
            <div class="">Rp <?php echo $fetch_events['harga_events']; ?></div>
            <p><?php echo $fetch_events['deskripsi_event']; ?></p>
            <a href="admin-event.php?update=<?php echo $fetch_events['id_events']; ?>" class="btn text-decoration-none btn-secondary">Update</a>
            <a href="admin-event.php?delete=<?php echo $fetch_events['id_events']; ?>" class="btn text-decoration-none" onclick="return confirm('Delete this event?');">Delete</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">No Events Added Yet!</p>';
      }
      ?>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
