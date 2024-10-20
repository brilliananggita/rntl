<?php
include 'koneksi.php';
?>

<form action="submit_pengembalian.php" method="post">
    <h2>Form Pengembalian Mobil</h2>

    <label for="id_kembali">ID Pengembalian:</label>
    <input type="text" id="id_kembali" name="id_kembali" required><br><br>

    <label for="id_transaksi">ID Transaksi:</label>
    <input type="text" id="id_transaksi" name="id_transaksi" required><br><br>

    <label for="tgl_kembali">Tanggal Kembali:</label>
    <input type="date" id="tgl_kembali" name="tgl_kembali" required><br><br>

    <label for="kondisi_mobil">Kondisi Mobil:</label>
    <textarea id="kondisi_mobil" name="kondisi_mobil" required></textarea><br><br>

    <label for="denda">Denda (Jika Ada):</label>
    <input type="number" id="denda" name="denda" step="0.01"><br><br>

    <input type="submit" value="Submit">
</form>
