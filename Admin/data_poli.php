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
            <h1 class="title text-xl font-bold flex-grow">Welcome, <span><?= $_SESSION['username']; ?></span> Your Admin</h1>
            
            <div class="flex items-start">
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
    <main class="content pt-16">
        <div class="p-6">
            <div class="rounded overflow-hidden">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Data Poliklinik</h2>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="poliSearch" placeholder="Cari Poliklinik..." 
                                   class="pl-8 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded flex items-center">
                            <i class="fas fa-plus mr-1" onclick="window.location.href='tambah_poli.php'"></i>
                            <span class="hidden sm:block" onclick="window.location.href='tambah_poli.php'">Tambah Poliklinik</span>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:justify-between mb-3 gap-3 md:gap-0 items-center">
                    <div class="flex items-center gap-2 text-gray-700 select-none">
                        Menampilkan
                        <select id="entriesPerPage" class="border border-gray-300 rounded px-2 py-1 cursor-pointer" aria-label="Entries per page">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                        </select>
                        entries
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded focus:ring-2 focus:ring-gray-500" title="Copy to Clipboard" id="copyButton">Copy</button>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded focus:ring-2 focus:ring-gray-500" title="Export as CSV" id="csvButton">CSV</button>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded focus:ring-2 focus:ring-gray-500" title="Print Table" id="printButton">Print</button>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded focus:ring-2 focus:ring-gray-500" title="Export as Excel" id="excelButton">Excel</button>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow bg-white table-responsive overflow-x-auto">
                    <table class="min-w-full border-collapse" id="tabelPoli">
                        <thead class="table-header-red text-left select-none">
                            <tr class="border-b border-red-700">
                                <th scope="col" class="py-3 px-4 w-20 cursor-pointer">No</th>
                                <th scope="col" class="py-3 px-4 cursor-pointer">Nama Poliklinik</th>
                                <th scope="col" class="py-3 px-4 w-30 cursor-pointer">Gedung</th>
                                <th scope="col" class="py-3 px-4 w-40 cursor-pointer text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white border-collapse" id="poliTableBody">
                            <?php
                            include("../database.php");

                            $poli = [];
                            $sql = "SELECT * FROM poliklinik";
                            $query = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($query)) {
                                $poli[] = $row;
                            }

                            // Konversi ke JSON
                            $poli_json = json_encode($poli);
                            ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Table Pagination" class="mt-4 flex justify-end space-x-1">
                    <button id="prevPage" class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 disabled:opacity-50" disabled>Previous</button>
                    <div id="paginationNumbers" class="flex gap-1"></div>
                    <button id="nextPage" class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">Next</button>
                </nav>

                <div class="text-sm text-gray-500">
                    Menampilkan <span id="showingFrom">0</span> - <span id="showingTo">0</span> dari <span id="totalpoli">0</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        const poli = <?= $poli_json ?>;
    </script>
    <script src="Javascript/data_poli.js"></script>
</body>
</html>