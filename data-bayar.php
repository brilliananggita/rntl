<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tb_bayar
$sql = "SELECT * FROM tb_bayar";
$result = $koneksi->query($sql);

// Memeriksa apakah ada data
if ($result->num_rows > 0) {
    // Membuat tabel HTML
    echo "<table border='1'>
            <tr>
                <th>ID Bayar</th>
                <th>ID Kembali</th>
                <th>Tanggal Bayar</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>";
    
    // Mengambil data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_bayar"] . "</td>
                <td>" . $row["id_kembali"] . "</td>
                <td>" . $row["tgl_bayar"] . "</td>
                <td>" . $row["total_bayar"] . "</td>
                <td>" . $row["status"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 hasil ditemukan";
}

// Menutup koneksi
$koneksi->close();
?>
