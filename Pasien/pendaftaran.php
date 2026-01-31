<?php 
// Include koneksi database dari parent folder
require_once __DIR__ . '/../database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/pendaftaran.css">
    <title>Pendaftaran</title>
</head>
<body>
    <header>
        <div class="kembali">
            <a href="dashboard_pasien.php">Kembali</a>
        </div>
    </header>
    <div class="box">
        <form action="daftar.php" method="POST">
            <h2>Pendaftaran Pasien</h2>
            <div class="input-box">
                <input type="text" name="no_rm" required>
                <label>No Rekam Medis</label>
            </div>
            <div class="input-box">
                <input type="text" name="nama" required>
                <label>Nama</label>
            </div>
            <div class="input-box">
                <input type="date" name="tanggal_lahir" required>
                <label>Tanggal Lahir</label>
            </div>
            <div class="gender-box">
                <label>Jenis Kelamin</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="rg-female" name="jenis_kelamin" value="perempuan">
                <label for="rg-female">Perempuan</label>
                <input type="radio" id="rg-male" name="jenis_kelamin" value="laki-laki">
                <label for="rg-male">Laki-Laki</label>
            </div>
            <select class="role-box" name="dokter_id" required>
                <option value="">Pilih Dokter</option>
                <?php
                    $dokter = $conn->query("SELECT id, nama_dokter FROM dokter");
                    while ($d = $dokter->fetch_assoc()) {
                        $selected = ($d['id'] == $data['dokter_id']) ? 'selected' : '';
                        echo "<option value='{$d['id']}' $selected>{$d['nama_dokter']}</option>";
                    }
                ?>
            </select>
            <div class="input-box">
                <input type="date" name="tanggal_periksa" required>
                <label>Tanggal Periksa</label>
            </div>
            <select class="role-box" name="poli_id" required>
                <option value="">Pilih Poli</option>
                <?php
                    $poli = $conn->query("SELECT id, poli FROM poliklinik");
                    while ($pl = $poli->fetch_assoc()) {
                        $selected = ($pl['id'] == $data['poli_id']) ? 'selected' : '';
                        echo "<option value='{$pl['id']}' $selected>{$pl['poli']}</option>";
                    }
                ?>
            </select>
            <div class="input-box">
                <input type="number" name="no_telepon" required>
                <label>No Telepon</label>
            </div>
            <button type="submit" class="btn" name="daftar">Daftar</button>
        </form>
    </div>
</body>
</html>