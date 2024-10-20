<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tb_mobil
$sql = "SELECT * FROM tb_mobil";
$result = $koneksi->query($sql);

// Memeriksa apakah ada data
if ($result->num_rows > 0) {
    // Membuat tabel HTML
    echo "<table border='1'>
            <tr>
                <th>Nomor Polisi</th>
                <th>Brand</th>
                <th>Tipe</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>";
    
    // Mengambil data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nopol"] . "</td>
                <td>" . $row["brand"] . "</td>
                <td>" . $row["type"] . "</td>
                <td>" . $row["tahun"] . "</td>
                <td>" . $row["harga"] . "</td>
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
