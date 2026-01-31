<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . '/../database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/data_dokter.css">
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
            
            <div class="flex items-start">
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

    <!-- Main Content -->
    <main class="content pt-16">
        <div class="p-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b">
                    <h2 class="text-lg font-semibold">Data Dokter</h2>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="doctorSearch" placeholder="Cari Dokter..." 
                                   class="pl-3 sm:pl-8 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokter</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="doctorTableBody">
                            <!-- Data pasien akan diisi oleh JavaScript -->
                            <?php
                            include("../database.php");

                            $doctors = [];
                            $sql = "SELECT * FROM dokter";
                            $query = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($query)) {
                                $doctors[] = $row;
                            }

                            // Konversi ke JSON
                            $doctors_json = json_encode($doctors);
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span id="showingFrom">0</span> - <span id="showingTo">0</span> dari <span id="totaldoctors">0</span>
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 border rounded bg-gray-100 text-gray-700 disabled"><</button>
                        <button class="px-3 py-1 border rounded bg-blue-600 text-white">1</button>
                        <button class="px-3 py-1 border rounded bg-gray-100 text-gray-700">></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const doctors = <?= $doctors_json ?>;
    </script>
    <script src="Javascript/data_dokter.js"></script>
</body>
</html>