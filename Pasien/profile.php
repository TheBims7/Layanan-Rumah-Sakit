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
    <link rel="stylesheet" href="CSS/style_profile.css">
    <title>Profil</title>
</head>
<body>
    <header>
        <nav>
            <a href="dashboard_pasien.php">Kembali</a>
            <ul>
                <li><a href="ganti_password.php">Ubah Password</a></li>
            </ul>
        </nav>
    </header>
    <div>
        <img class="img" src="Images/profile.png" alt="">
        <h1>USER PROFIL</h1>
    </div>
    <div class="box">
        <div class="form">
            <h2>USERNAME</h2>
            <div class="data">
                <p><?php echo $_SESSION['username']?></p>
            </div>
            <h2>EMAIL</h2>
            <div class="data">
                <p><?php echo $_SESSION['email']?></p>
            </div>
            <button type="submit" onclick="window.location.href='edit_profile.php'">Edit</button>
        </div>
    </div>
</body>
</html>