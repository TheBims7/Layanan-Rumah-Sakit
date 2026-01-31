<?php
include("../database.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login
if (!isset($_SESSION['user_id'])) {
    echo "Anda harus login terlebih dahulu.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil semua data riwayat berdasarkan user_id
$query = "
    SELECT 
        p.*,
        d.nama_dokter,
        pl.poli
    FROM pendaftaran p
    LEFT JOIN dokter d ON p.dokter_id = d.id
    LEFT JOIN poliklinik pl ON p.poli_id = pl.id
    WHERE p.user_id = ?
    ORDER BY p.tanggal_periksa DESC, p.id DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Simpan data untuk JavaScript
$registrations_data = [];
while ($row = $result->fetch_assoc()) {
    $registrations_data[] = $row;
}

// Ambil detail jika ada parameter ?id=
$data = null;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "
        SELECT 
            p.*,
            d.nama_dokter,
            pl.poli
        FROM pendaftaran p
        LEFT JOIN dokter d ON p.dokter_id = d.id
        LEFT JOIN poliklinik pl ON p.poli_id = pl.id
        WHERE p.id = ? AND p.user_id = ?
    ";

    $detailQuery = $conn->prepare($sql);
    $detailQuery->bind_param("ii", $id, $user_id);
    $detailQuery->execute();

    $detailResult = $detailQuery->get_result();
    if ($detailResult->num_rows > 0) {
        $data = $detailResult->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='riwayat.php';</script>";
        exit;
    }

    $detailQuery->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/riwayat_pendaftaran.css">
    <title>Riwayat Pendaftaran</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard_pasien.php">Kembali</a></li>
            </ul>
        </nav>
    </header>
    <section class="table-wrapper">
        <div>
            <h1>Riwayat Pendaftaran</h1>
        </div>
        <?php if (count($registrations_data) > 0): ?>
        <table border="1" cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>No Antrian</th>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>Dokter</th>
                    <th>Tanggal Periksa</th>
                    <th>Poli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations_data as $row): ?>
                    <tr>
                        <td class="tengah"><?= htmlspecialchars($row['antrian']) ?></td>
                        <td><?= htmlspecialchars($row['no_rm']) ?></td>
                        <td class="spasi"><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_periksa']) ?></td>
                        <td><?= htmlspecialchars($row['poli']) ?></td>
                        <td class="aksi">
                            <button class="lihat" onclick="openModal(<?= $row['id'] ?>)">
                                <i class="fas fa-eye"></i>
                                <span class="tulisan">Detail</span>
                            </button>
                            <button class="hapus" onclick="showPopup()">
                                <i class="fas fa-trash"></i>
                                <span class="tulisan">Hapus</span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div style="text-align: center; padding: 20px;">
                <p>Tidak ada riwayat pendaftaran.</p>
            </div>
        <?php endif; ?>
    </section>
    
    <!-- Modal -->
    <div class="popup" id="detailModal">
        <div class="popup_detail">
            <div class="popup-header">
                <h2>Detail Riwayat Pendaftaran</h2>
                <a href="#" class="popup_close" onclick="closeModal()">&times;</a>
            </div>
            <div class="popup-text" id="popupContent">
                <!-- Content will be inserted by JavaScript -->
            </div>
        </div>
    </div> 

    <div id="popup">
        <div id="popup-content">
            <p>Yakin ingin menghapus data ini?</p>
            <button class="btn-no" onclick="hidePopup()">Batal</button>
            <button class="btn-yes" onclick="confirmDelete(<?= $row['id'] ?>)">Ya, Hapus</button>
        </div>
    </div>
    
    <script>
        // Data dari PHP
        const registrations = <?php echo json_encode($registrations_data); ?>;
    </script>
    <script src="JS/riwayat_pendaftaran.js"></script>
</body>
</html>