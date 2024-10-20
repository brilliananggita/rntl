<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tb_user
$sql = "SELECT * FROM tb_user";
$result = $koneksi->query($sql);

// Memeriksa apakah ada data
if ($result->num_rows > 0) {
    // Membuat tabel HTML
    echo "<table border='1'>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
            </tr>";
    
    // Mengambil data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_user"] . "</td>
                <td>" . $row["username"] . "</td>
                <td>" . $row["role"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 hasil ditemukan";
}

// Menutup koneksi
$koneksi->close();
?>
