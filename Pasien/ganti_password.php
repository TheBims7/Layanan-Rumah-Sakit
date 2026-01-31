<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/ganti_password.css">
    <title>Ganti Password</title>
</head>
<body>
    <div class="wrapper">
        <form action="ubah.php" method="POST">
            <h2>Ubah Password</h2>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" id="password" placeholder="Password Lama" name="password_lama" required>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" id="password" placeholder="Password Baru" name="password_baru" required>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" id="password" placeholder="Konfirmasi Password" name="konfirmasi_password" required>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="showPassword">
                <label>Tampilkan Password</label>
            </div>
            <button type="submit" name="ganti">Ubah</button>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="JS/ganti_password.js"></script>
</body>
</html>