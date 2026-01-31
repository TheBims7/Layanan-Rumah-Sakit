<?php
include("../database.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location.href='data_pasien.php';</script>";
    exit();
}

$id = $_GET['id'];

$sql = "
    SELECT
        p.*,
        d.nama_dokter,
        pl.poli
    FROM pendaftaran p
    JOIN dokter d ON p.dokter_id = d.id
    JOIN poliklinik pl ON p.poli_id = pl.id
    WHERE p.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='data_pasien.php';</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/tambah_pasien.css">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="header text-white h-16 shadow-md fixed w-full z-20">
        <div class="flex items-center h-full px-4">
            <button id="sidebarToggle" class="hamburger active mr-4 text-white focus:outline-none">
                <div class="w-6 space-y-1.5">
                    <span class="block h-0.5 bg-white"></span>
                    <span class="block h-0.5 bg-white"></span>
                    <span class="block h-0.5 bg-white"></span>
                </div>
            </button>
            <h1 class="title text-xl font-bold flex-grow">Welcome, <span><?= $_SESSION['username']; ?></span> Your Doctor</h1>
            
            <div class="flex items-start justify-between">
                <div class="relative group">
                    <div class="cursor-pointer text-white">
                        <span class="font-medium">Dokter</span>
                    </div>
                    <div class="absolute right-0 top-full w-48 bg-white rounded-md shadow-lg hidden group-hover:block">
                        <a href="ganti_password.php" class="text-blue-600 px-4 py-2 block"><i class="fas fa-key mr-2"></i>Ganti Password</a>
                        <div class="border-t border-gray-200"></div>
                        <a href="../logout.php" class="text-red-600 px-4 py-2 block" onclick="return confirm('Apakah kamu yakin ingin logout?')"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar text-white">
        <div class="overflow-y-auto h-[calc(100vh-64px)]">
            <div class="py-2">
                <a href="dashboard_dokter.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="data_dokter.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Data Dokter</span>
                </a>
                
                <div class="menu-item">
                    <div class="flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 cursor-pointer" onclick="toggleSubMenu('dataPasien')">
                        <div class="flex items-center">
                        <a href="data_pasien.php">    
                            <select class="role-box ml-2" onchange="location = this.value;">
                                <option value="data_pasien.php">Data Pasien</option>
                            </select>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="content">
        <div class="edit">
            <h1>Edit Data Pasien</h1>
        </div>
        <div class="box">
            <div class="form">
                <form action="proses_edit.php" method="POST">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <h2>No Rekam Medis</h2>
                    <input type="text" name="no_rm" value="<?= $data['no_rm'] ?>">
                    <h2>Antrian</h2>
                    <input type="text" name="antrian" value="<?= $data['antrian'] ?>">
                    <h2>Nama Pasien</h2>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>">
                    <h2>Tanggal Lahir Pasien</h2>
                    <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
                    <h2>Jenis Kelamin</h2>
                    <select class="role" name="jenis_kelamin">
                        <option value=""></option>
                        <option value="perempuan" <?= $data['jenis_kelamin'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        <option value="laki-laki" <?= $data['jenis_kelamin'] == 'laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                    </select>   
                    <h2>Nama Dokter</h2>
                    <select class="role" name="dokter_id">
                        <?php
                            $dokter = $conn->query("SELECT id, nama_dokter FROM dokter");
                            while ($d = $dokter->fetch_assoc()) {
                                $selected = ($d['id'] == $data['dokter_id']) ? 'selected' : '';
                                echo "<option value='{$d['id']}' $selected>{$d['nama_dokter']}</option>";
                            }
                        ?>
                    </select>
                    <h2>Tanggal Periksa</h2>
                    <input type="date" name="tanggal_periksa" value="<?= $data['tanggal_periksa'] ?>">
                    <h2>Poliklinik</h2>
                    <select class="role" name="poli_id">
                        <?php
                            $poli = $conn->query("SELECT id, poli FROM poliklinik");
                            while ($pl = $poli->fetch_assoc()) {
                                $selected = ($pl['id'] == $data['poli_id']) ? 'selected' : '';
                                echo "<option value='{$pl['id']}' $selected>{$pl['poli']}</option>";
                            }
                        ?>
                    </select>
                    <h2>No Telepon</h2>
                    <input type="number" name="no_telepon" value="<?= $data['no_telepon'] ?>"><br>
                    <button type="submit" name="edit">Update Pasien</button>
                </form>
            </div>        
        </div>                   
    </main>
    <script src="Javascript/edit.js"></script>
</body>
</html>