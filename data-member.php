<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tb_member
$sql = "SELECT * FROM tb_member";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-custom th {
            background-color: #4287f5; /* Warna biru untuk header tabel */
            color: white; /* Warna teks header tabel menjadi putih */
        }
        .table-custom {
            background-color: white; /* Warna latar belakang tabel isi putih */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Member</h2>
        
        <!-- Tombol Tambah Anggota di kanan -->
        <div class="mb-3 text-end">
            <a href="tambah-member.php" class="btn btn-success">Tambah Anggota</a>
        </div>

        <table class="table table-bordered table-hover table-striped table-custom">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Username</th>
                    <th>Aksi</th> <!-- Kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["nik"] . "</td>
                                <td>" . $row["nama"] . "</td>
                                <td>" . $row["jk"] . "</td>
                                <td>" . $row["telp"] . "</td>
                                <td>" . $row["alamat"] . "</td>
                                <td>" . $row["username"] . "</td>
                                <td>
                                    <a href='edit_member.php?nik=" . $row["nik"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='hapus_member.php?nik=" . $row["nik"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus member ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data member</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS & Popper.js (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$koneksi->close();
?>
