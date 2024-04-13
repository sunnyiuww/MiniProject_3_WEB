<?php
// admin-user.php

include '../../php/koneksi.php';

session_start();

// Memeriksa apakah parameter 'delete' ada pada URL dan tidak kosong
if(isset($_GET['delete']) && !empty($_GET['delete'])) {
    // Menghindari serangan injeksi SQL dengan menggunakan prepared statement
    $delete_user_id = $_GET['delete'];
    $delete_query = mysqli_prepare($con, "DELETE FROM `user` WHERE `id_user` = ?");
    mysqli_stmt_bind_param($delete_query, "i", $delete_user_id);
    
    // Menjalankan query
    if(mysqli_stmt_execute($delete_query)) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman user-panel.php
        header("Location: user-panel.php");
        exit;
    } else {
        // Jika terjadi kesalahan dalam menghapus pengguna
        echo "Gagal menghapus pengguna.";
    }
}
?>
