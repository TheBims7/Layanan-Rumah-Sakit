<?php
include("../database.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $current_user = $_SESSION['username'];

    $fields = [];
    $params = [];
    $types = '';

    // Tambahkan field yang diisi saja
    if (!empty($newUsername)) {
        $fields[] = "username=?";
        $params[] = $newUsername;
        $types .= 's';
    }

    if (!empty($newEmail)) {
        $fields[] = "email=?";
        $params[] = $newEmail;
        $types .= 's';
    }

    if (count($fields) > 0) {
        $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE username=?";
        $params[] = $current_user;
        $types .= 's';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $query = $stmt->execute();

        if ($query) {
            if (!empty($newUsername)) {
                $_SESSION['username'] = $newUsername;
            }
            if (!empty($newEmail)) {
                $_SESSION['email'] = $newEmail;
            }
            header('Location: dashboard_dokter.php');
        } else {
            die("Gagal menyimpan perubahan...");
        }
    } else {
        echo "Tidak ada data yang diubah.";
    }
} else {
    die("Akses dilarang...");
}
?>
