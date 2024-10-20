<?php
$koneksi = new mysqli('localhost', 'root', '', 'rental_mobil');

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
