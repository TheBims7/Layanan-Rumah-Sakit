<?php
include("../database.php");

if (isset($_POST['edit_dokter'])) {
    $id = $_POST['id'];
    $nama_dokter = $_POST['nama_dokter'];
    $NIP = $_POST['NIP'];
    $status_dokter = $_POST['status_dokter'];

    $update_sql = "UPDATE dokter SET 
        nama_dokter='$nama_dokter', NIP='$NIP', status_dokter='$status_dokter' WHERE id='$id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='data_dokter.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui: " . $conn->error . "'); history.back();</script>";
    }
}
?>
