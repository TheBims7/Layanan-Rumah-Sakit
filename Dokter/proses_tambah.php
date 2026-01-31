<?php
session_start();
include("../database.php");

if (isset($_POST['tambah'])) {
    $no_rm = $_POST['no_rm'];
    $antrian = $_POST['antrian'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $dokter_id = $_POST['dokter_id'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $poli_id = $_POST['poli_id'];
    $no_telepon = $_POST['no_telepon'];

    // Validasi data
    if (empty($no_rm) || empty($antrian) || empty($nama) || empty($tanggal_lahir) || empty($jenis_kelamin) || 
        empty($dokter_id) || empty($tanggal_periksa) || empty($poli_id) || empty($no_telepon)) {
        die("<script>alert('Semua field harus diisi'); history.back();</script>");
    }

    // Siapkan statement SQL
    $stmt = $conn->prepare("INSERT INTO pendaftaran 
        (no_rm, antrian, nama, tanggal_lahir, jenis_kelamin, dokter_id, tanggal_periksa, poli_id, no_telepon)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("<script>alert('Error preparing statement: ".$conn->error."'); history.back();</script>");
    }

    // Bind parameter
    $stmt->bind_param("sisssisis", $no_rm, $antrian, $nama, $tanggal_lahir, $jenis_kelamin, 
                     $dokter_id, $tanggal_periksa, $poli_id, $no_telepon);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "<script>alert('Tambah pasien berhasil!'); window.location.href='data_pasien.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar: ".$stmt->error."'); history.back();</script>";
    }
}
?>
