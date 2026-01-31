<?php
session_start();
include("../database.php");

if (isset($_POST['tambah'])) {
    $poli = $_POST['poli'];
    $gedung = $_POST['gedung'];

    // Validasi data
    if (empty($poli) || empty($gedung)) {
        die("<script>alert('Semua field harus diisi'); history.back();</script>");
    }

    // Siapkan statement SQL
    $stmt = $conn->prepare("INSERT INTO poliklinik (poli, gedung) VALUES (?, ?)");

    if ($stmt === false) {
        die("<script>alert('Error preparing statement: ".$conn->error."'); history.back();</script>");
    }

    // Bind parameter
    $stmt->bind_param("ss", $poli, $gedung);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "<script>alert('Tambah poliklinik berhasil!'); window.location.href='data_poli.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar: ".$stmt->error."'); history.back();</script>";
    }
}
?>
