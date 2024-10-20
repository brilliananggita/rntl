<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tb_kembali
$sql = "SELECT * FROM tb_kembali";
$result = $koneksi->query($sql);

// Memeriksa apakah ada data
if ($result->num_rows > 0) {
    // Membuat tabel HTML
    echo "<table border='1'>
            <tr>
                <th>ID Kembali</th>
                <th>ID Transaksi</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Mobil</th>
                <th>Denda</th>
            </tr>";
    
    // Mengambil data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_kembali"] . "</td>
                <td>" . $row["id_transaksi"] . "</td>
                <td>" . $row["tgl_kembali"] . "</td>
                <td>" . $row["kondisi_mobil"] . "</td>
                <td>" . $row["denda"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 hasil ditemukan";
}

// Menutup koneksi
$koneksi->close();
?>
