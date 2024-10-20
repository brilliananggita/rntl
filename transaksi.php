<?php
// konfirmasi_bayar.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kembali = $_POST['id_kembali'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $total_bayar = $_POST['total_bayar'];

    $stmt = $pdo->prepare("INSERT INTO tbl_bayar (id_kembali, tgl_bayar, total_bayar, status) 
                           VALUES (?, ?, ?, 'lunas')");
    $stmt->execute([$id_kembali, $tgl_bayar, $total_bayar]);

    echo "Pembayaran berhasil dikonfirmasi!";
}
?>

<form action="konfirmasi_bayar.php" method="POST">
    ID Pengembalian: <input type="number" name="id_kembali" required><br>
    Tanggal Bayar: <input type="date" name="tgl_bayar" required><br>
    Total Bayar: <input type="number" name="total_bayar" required><br>
    <input type="submit" value="Konfirmasi Pembayaran">
</form>
