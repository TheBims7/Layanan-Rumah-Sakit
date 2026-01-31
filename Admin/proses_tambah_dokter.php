<?php
session_start();
include("../database.php");

if (isset($_POST['tambah'])) {
    $nama_dokter = $_POST['nama_dokter'];
    $NIP = $_POST['NIP'];
    $status_dokter = $_POST['status_dokter'];

    // Validasi data
    if (empty($nama_dokter) || empty($NIP) || empty($status_dokter)) {
        die("<script>alert('Semua field harus diisi'); history.back();</script>");
    }

    // Siapkan statement SQL
    $stmt = $conn->prepare("INSERT INTO dokter (nama_dokter, NIP, status_dokter) VALUES (?, ?, ?)");

    if ($stmt === false) {
        die("<script>alert('Error preparing statement: ".$conn->error."'); history.back();</script>");
    }

    // Bind parameter
    $stmt->bind_param("sss", $nama_dokter, $NIP, $status_dokter);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "<script>alert('Tambah dokter berhasil!'); window.location.href='data_dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar: ".$stmt->error."'); history.back();</script>";
    }
}
?>
