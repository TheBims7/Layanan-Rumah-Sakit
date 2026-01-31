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
    <link rel="stylesheet" href="CSS/edit_profile.css">
    <title>Edit Profil</title>
</head>
<body>
    <header>
        <nav>
            <a href="profile.php">Kembali</a>
        </nav>
    </header>
    <div>
        <h1>EDIT PROFIL</h1>
    </div>
    <div class="box">
        <div class="form">
            <form action="edit.php" method="POST">
                <h2>USERNAME</h2>
                <input type="text" name="username">
                <h2>EMAIL</h2>
                <input type="email" name="email"><br>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>