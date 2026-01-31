<?php
include("../database.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$message = '';

if (isset($_POST['ganti'])) {
    $username = $_SESSION['username'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    // Cek konfirmasi password
    if ($password_baru !== $konfirmasi) {
        echo "<script>alert('Konfirmasi password baru tidak cocok.'); window.history.back();</script>";
        exit();
    }

    // Ambil password lama dari DB
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password lama
    if (!password_verify($password_lama, $user['password'])) {
        echo "<script>alert('Password lama salah.'); window.history.back();</script>";
        exit();
    }

    // Hash password baru
    $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

    // Update password baru ke DB
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
    $stmt->bind_param("ss", $hashed_password, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil diganti.'); window.location.href='dashboard_dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal mengganti password.'); window.history.back();</script>";
    }
} else {
    die("Akses ditolak.");
}
?>
