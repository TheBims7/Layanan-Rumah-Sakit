<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/dasboard_pasien.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <nav>
            <h1>Welcome, <span><?= $_SESSION['username']; ?></span></h1>
            <ul id="menuList">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a class="logout" onclick="showPopup()">Logout</a></li>
            </ul>
            <div class="menu-icon">
                <i class="fa-solid fa-bars" onclick="toggleMenu()"></i>
            </div>
        </nav>
    </header>
    <div id="popup">
        <div id="popup-content">
            <p>Apakah kamu yakin ingin logout?</p>
            <button class="btn-yes" onclick="logout()">Yes</button>
            <button class="btn-no" onclick="hidePopup()">No</button>
        </div>
    </div>
    <section id="home" class="home">
        <div class="label">
            <h2>Layanan Rumah Sakit Umar Al Fatih</h2>
        </div>
    </section>
    <section id="services" class="service">
        <div class="box">
            <div class="card">
                <img class="img" src="Images/user.png">
                <div class="menu">
                    <a class="button" href="profile.php">Profil</a>
                </div>
            </div>
            <div class="card">
                <img class="img" src="Images/daftar.png">
                <div class="menu">
                    <a class="button" href="pendaftaran.php">Pendaftaran</a>
                </div>
            </div>
            <div class="card">
                <img class="img" src="Images/history.png">
                <div class="history">
                    <a class="button" href="riwayat_pendaftaran.php">Riwayat Pendaftaran</a>
                </div>
            </div>
        </div>
    </section>  
    <section id="about" class="about">
        <div class="profil">
            <h2>Profil Rumah Sakit Umar Al Fatih</h2>
            <h3>Visi:</h3>
            <p>Menjadi rumah sakit unggulan yang memberikan pelayanan kesehatan terbaik, profesional, dan berorientasi pada kepuasan pasien.</p>
            <h3>Misi:</h3>
            <ul class="misi">
                <li> Memberikan pelayanan kesehatan yang cepat, tepat, dan bermutu.</li>
                <li>Mengutamakan keselamatan dan kenyamanan pasien.</li>
                <li>Mengembangkan sumber daya manusia yang profesional dan berintegritas.</li>
                <li>Menyediakan fasilitas dan teknologi medis yang modern.</li>
                <li>Menjalin kemitraan dengan berbagai pihak dalam bidang kesehatan.</li>
            </ul>
            <h3>Layanan Unggulan:</h3>
            <ul>
                <li>Instalasi Gawat Darurat (IGD) 24 Jam</li>
                <li>Rawat Inap dan Rawat Jalan</li>
                <li>Klinik Spesialis (Penyakit Dalam, Anak, Bedah, Kandungan, dll)</li>
                <li>Laboratorium dan Radiologi</li>
                <li>Layanan Medical Check Up</li>
                <li>Apotek dan Konsultasi Gizi</li>
            </ul>
            <h3>Fasilitas:</h3>
            <ul>
                <li>Ruang perawatan standar hingga VIP</li>
                <li>Ruang ICU dan NICU</li>
                <li>Ruang operasi berstandar nasional</li>
                <li>Sistem pendaftaran online dan informasi digital pasien</li>
            </ul>
            <h3>Moto:</h3>
            <p>“Peduli, Ramah, Profesional, dan Terpercaya.”</p>
        </div>
     </section> 
     <footer>
        <ion-icon name="globe-outline"></ion-icon><a>https://rsumaralfatih.co.id</a>
        <i class="fa-solid fa-envelope"></i><a>rsuaf@gmail.com</a>
        <i class="fa-brands fa-whatsapp"></i><a>0853-4527-1192</a>
        <i class="fa-brands fa-instagram"></i><a>@rs_umaralfatih</a>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
    <script src="JS/dashboard_pasien.js"></script>
</body>
</html>