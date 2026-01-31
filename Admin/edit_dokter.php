<?php
include("../database.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location.href='data_dokter.php';</script>";
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM dokter WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='data_dokter.php';</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/tambah_dokter.css">
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
            <h1 class="title text-xl font-bold flex-grow">Welcome, <span><?= $_SESSION['username']; ?></span> Your Admin</h1>
            
            <div class="flex items-start justify-between">
                <div class="relative group">
                    <div class="cursor-pointer text-white">
                        <span class="font-medium">Admin</span>
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
                <a href="dashboard_admin.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="data_dokter.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Data Dokter</span>
                </a>

                <a href="data_poli.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Data Poliklinik</span>
                </a>

                <a href="akun.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Daftar Akun</span>
                </a>

                <a href="login.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Aktivitas Login</span>
                </a>

                <a href="aktivitas.php" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800">
                    <span class="ml-3">Aktivitas</span>
                </a>
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
                <form action="proses_edit_dokter.php" method="POST">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <h2>Nama Dokter</h2>
                    <input type="text" name="nama_dokter" value="<?= $data['nama_dokter'] ?>">
                    <h2>NIP</h2>
                    <input type="text" name="NIP" value="<?= $data['NIP'] ?>">
                    <h2>Status Dokter</h2>
                    <input type="text" name="status_dokter" value="<?= $data['status_dokter'] ?>"><br>
                    <button type="submit" name="edit_dokter">Update Dokter</button>
                </form>
            </div>   
        </div>                        
    </main>
    <script src="Javascript/edit.js"></script>
</body>
</html>