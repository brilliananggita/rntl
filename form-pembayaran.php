<?php
include 'koneksi.php';

// Ambil data dari form
$id_bayar = $_POST['id_bayar'];
$id_kembali = $_POST['id_kembali'];
$tgl_bayar = $_POST['tgl_bayar'];
$total_bayar = $_POST['total_bayar'];
$status = $_POST['status'];

// Query untuk memasukkan data pembayaran
$sql = "INSERT INTO tb_bayar (id_bayar, id_kembali, tgl_bayar, total_bayar, status)
        VALUES ('$id_bayar', '$id_kembali', '$tgl_bayar', '$total_bayar', '$status')";

if ($koneksi->query($sql) === TRUE) {
    echo "Pembayaran berhasil disimpan!";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>


?>

<form action="" method="post">
    <h2>Form Pembayaran</h2>

    <label for="id_bayar">ID Pembayaran:</label>
    <input type="text" id="id_bayar" name="id_bayar" required><br><br>

    <label for="id_kembali">ID Pengembalian:</label>
    <input type="text" id="id_kembali" name="id_kembali" required><br><br>

    <label for="tgl_bayar">Tanggal Pembayaran:</label>
    <input type="date" id="tgl_bayar" name="tgl_bayar" required><br><br>

    <label for="total_bayar">Total Pembayaran:</label>
    <input type="number" id="total_bayar" name="total_bayar" step="0.01" required><br><br>

    <label for="status">Status Pembayaran:</label>
    <select id="status" name="status">
        <option value="lunas">Lunas</option>
        <option value="belum lunas">Belum Lunas</option>
    </select><br><br>

    <input type="submit" value="Submit">
</form>
