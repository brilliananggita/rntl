<?php
// Koneksi ke database
include 'koneksi.php';
// Menampilkan daftar transaksi
$sql = "SELECT * FROM tb_transaksi";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
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
        <h2 class="text-center mb-4">Daftar Transaksi Penyewaan Mobil</h2>
        <table class="table table-bordered table-hover table-striped table-custom"> <!-- Tambahkan kelas table-custom -->
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>NIK</th>
                    <th>Nopol</th>
                    <th>Tanggal Transaksi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Supir</th>
                    <th>Total</th>
                    <th>DownPayment</th>
                    <th>Kekurangan</th>
                    <th>Status</th>
                    <th>Approve</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_transaksi'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['nopol'] . "</td>";
                        echo "<td>" . $row['tgl_booking'] . "</td>";
                        echo "<td>" . $row['tgl_ambil'] . "</td>";
                        echo "<td>" . $row['tgl_kembali'] . "</td>";
                        echo "<td>" . $row['supir'] . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "<td>" . $row['downpayment'] . "</td>";
                        echo "<td>" . $row['kekurangan'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td><a href='approve_transaksi.php?id=" . $row['id_transaksi'] . "' class='btn btn-success btn-sm'>Approve</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center'>Tidak ada transaksi</td></tr>";
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
