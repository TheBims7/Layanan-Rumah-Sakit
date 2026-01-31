<?php
include("../database.php");

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $no_rm = $_POST['no_rm'];
    $antrian = $_POST['antrian'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $dokter_id = $_POST['dokter_id'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $poli_id = $_POST['poli_id'];
    $no_telepon = $_POST['no_telepon'];

    $sql = "
        UPDATE pendaftaran SET
            no_rm = ?,
            antrian = ?,
            nama = ?,
            tanggal_lahir = ?,
            jenis_kelamin = ?,
            dokter_id = ?,
            tanggal_periksa = ?,
            poli_id = ?,
            no_telepon = ?
        WHERE id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sisssisisi",
        $no_rm,
        $antrian,
        $nama,
        $tanggal_lahir,
        $jenis_kelamin,
        $dokter_id,
        $tanggal_periksa,
        $poli_id,
        $no_telepon,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='data_pasien.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); history.back();</script>";
    }
}
?>
