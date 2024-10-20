<?php
include 'session.php'; // Memanggil file session.php untuk pemeriksaan akses

// Memeriksa akses hanya untuk admin
checkAccess('admin');

// // Jika pengguna memiliki akses, tampilkan konten halaman admin
// echo "<h1>Selamat datang di halaman Admin</h1>";
// Tambahkan konten admin lainnya di sini
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- kode buat navbar nyaa alias yg atas -->
    <div class="navbar">
        <div class="navbar-title"><button class="toggle-btn" onclick="toggleSidebar()">☰</button> Rental Mobil </div>
        <!-- buat profil nya apa -->
        <div class="profile">
            <a href="profil.php">
                <img src="image/pp.png" alt="Profile" class="profile-img">
            </a>
        </div>
    </div>

    <!-- buat side bar -->
    <div class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="mobil.php">mobil</a></li>
            <li><a href="hue.php">apa ya </a></li>
            <li><a href="halaman3.php">Halaman 3</a></li>
            <li><a href="halaman4.php">Halaman 4</a></li>
        </ul>
        

    </div>

    <div class="content" id="content">
        <!-- Konten utama di sini -->
        <h1>Selamat Datang di Rental Mobil</h1>
        <p>Ini adalah konten utama. Silakan pilih halaman di sidebar.</p>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('active');
            content.classList.toggle('active'); // Menambahkan kelas aktif pada konten
        }
    </script>
</body>
</html>



