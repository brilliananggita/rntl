<?php
include 'koneksi.php';

// Ambil data dari form
$id_kembali = $_POST['id_kembali'];
$id_transaksi = $_POST['id_transaksi'];
$tgl_kembali = $_POST['tgl_kembali'];
$kondisi_mobil = $_POST['kondisi_mobil'];
$denda = $_POST['denda'];

// Query untuk memasukkan data pengembalian
$sql = "INSERT INTO tb_kembali (id_kembali, id_transaksi, tgl_kembali, kondisi_mobil, denda)
        VALUES ('$id_kembali', '$id_transaksi', '$tgl_kembali', '$kondisi_mobil', '$denda')";

if ($koneksi->query($sql) === TRUE) {
    echo "Data pengembalian berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
