<?php
include 'koneksi.php';

// Mengambil NIK dari parameter URL
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];

    // Query untuk menghapus member berdasarkan NIK
    $sql = "DELETE FROM tb_member WHERE nik = '$nik'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Member berhasil dihapus!'); window.location.href='data-member.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "NIK tidak ditemukan!";
}

$koneksi->close();
?>
