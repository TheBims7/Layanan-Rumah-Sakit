<?php
include("../database.php");

if (isset($_POST['edit_poli'])) {
    $id = $_POST['id'];
    $poli = $_POST['poli'];
    $gedung = $_POST['gedung'];

    $update_sql = "UPDATE poliklinik SET 
        poli='$poli', gedung='$gedung' WHERE id='$id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='data_poli.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui: " . $conn->error . "'); history.back();</script>";
    }
}
?>
