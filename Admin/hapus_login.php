<?php
include("../database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $check = mysqli_query($conn, "SELECT * FROM login WHERE id = $id");
    $user = mysqli_fetch_assoc($check);

    if (!$user) {
        echo "<script>alert('Aktivitas tidak ditemukan.'); window.location.href='login.php';</script>";
        exit();
    }

    $sql = "DELETE FROM login WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('Aktivitas berhasil dihapus.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus aktifitas.'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah.'); window.location.href='login.php';</script>";
}
?>
