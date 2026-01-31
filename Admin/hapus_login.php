<?php
include("../database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek role terlebih dahulu
    $check = mysqli_query($conn, "SELECT * FROM login WHERE id = $id");
    $user = mysqli_fetch_assoc($check);

    if (!$user) {
        echo "<script>alert('Aktifitas tidak ditemukan.'); window.location.href='Login.php';</script>";
        exit();
    }

    // Jika bukan admin, lanjut hapus
    $sql = "DELETE FROM login WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('Aktifitas berhasil dihapus.'); window.location.href='Login.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus aktifitas.'); window.location.href='Login.php';</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah.'); window.location.href='Login.php';</script>";
}
?>
