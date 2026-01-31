<?php
include("../database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek role terlebih dahulu
    $check = mysqli_query($conn, "SELECT role FROM users WHERE id = $id");
    $user = mysqli_fetch_assoc($check);

    if (!$user) {
        echo "<script>alert('User tidak ditemukan.'); window.location.href='akun.php';</script>";
        exit();
    }

    if ($user['role'] === 'admin') {
        echo "<script>alert('Akun dengan role admin tidak boleh dihapus.'); window.location.href='akun.php';</script>";
        exit();
    }

    // Jika bukan admin, lanjut hapus
    $sql = "DELETE FROM users WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('User berhasil dihapus.'); window.location.href='akun.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user.'); window.location.href='akun.php';</script>";
    }
} else {
    echo "<script>alert('Akses tidak sah.'); window.location.href='akun.php';</script>";
}
?>
