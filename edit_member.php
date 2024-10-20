<?php
include 'koneksi.php';

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Mengambil NIK dari parameter URL
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];

    // Query untuk mengambil data member berdasarkan NIK
    $sql = "SELECT * FROM tb_member WHERE nik = '$nik'";
    $result = $koneksi->query($sql);

    // Memeriksa apakah member ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Member tidak ditemukan.");
    }
} else {
    die("NIK tidak ditemukan.");
}

// Memeriksa apakah data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];

    // Query untuk memperbarui data member
    $sql = "UPDATE tb_member SET nama='$nama', jk='$jk', telp='$telp', alamat='$alamat', username='$username' WHERE nik='$nik'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data member berhasil diperbarui!'); window.location.href='data-member.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Member</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $row['nik']; ?>" disabled>
            </div>
            <input type="hidden" name="nik" value="<?php echo $row['nik']; ?>"> <!-- Menyimpan NIK untuk digunakan saat update -->

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jk" name="jk" required>
                    <option value="L" <?php echo $row['jk'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo $row['jk'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $row['telp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $row['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="data-member.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap JS & Popper.js (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$koneksi->close();
?>
