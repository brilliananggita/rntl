<?php
session_start(); // Memulai session

// Fungsi untuk memeriksa akses
function checkAccess($role) {
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== $role) {
        // Jika user tidak terautentikasi atau tidak memiliki role yang sesuai, redirect ke halaman login
        header("Location: login.php");
        exit();
    }
}

// Contoh penggunaan:
// Gunakan di halaman admin.php
// checkAccess('admin');

// Gunakan di halaman petugas.php
// checkAccess('petugas');

// Gunakan di halaman member.php (atau halaman lain untuk member)
// checkAccess('member');
?>
