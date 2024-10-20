<?php
// tampil_kembali.php
include 'koneksi.php';

$query = $pdo->query("SELECT * FROM tbl_kembali");

echo "<h1>Pengembalian Mobil</h1>";
echo "<table border='1'>
        <tr>
            <th>ID Pengembalian</th>
            <th>ID Transaksi</th>
            <th>Tanggal Kembali</th>
            <th>Kondisi Mobil</th>
            <th>Denda</th>
        </tr>";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id_kembali']}</td>
            <td>{$row['id_transaksi']}</td>
            <td>{$row['tgl_kembali']}</td>
            <td>{$row['kondisi_mobil']}</td>
            <td>{$row['denda']}</td>
          </tr>";
}

echo "</table>";
?>
