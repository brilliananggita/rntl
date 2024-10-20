<?php
// form_sewa.php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];
    $nopol = $_POST['nopol'];
    $tgl_booking = $_POST['tgl_booking'];
    $tgl_ambil = $_POST['tgl_ambil'];
    $supir = $_POST['supir'];
    $durasi = $_POST['durasi'];
    $downpayment = $_POST['downpayment'];

    $stmt = $pdo->prepare("INSERT INTO tbl_transaksi (nik, nopol, tgl_booking, tgl_ambil, supir, durasi, downpayment) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nik, $nopol, $tgl_booking, $tgl_ambil, $supir, $durasi, $downpayment]);

    echo "Penyewaan berhasil ditambahkan!";
}
?>

<form action="form_sewa.php" method="POST">
    NIK: <input type="text" name="nik" required><br>
    No Polisi Mobil: <input type="text" name="nopol" required><br>
    Tanggal Booking: <input type="date" name="tgl_booking" required><br>
    Tanggal Ambil: <input type="date" name="tgl_ambil" required><br>
    Supir: 
    <select name="supir">
        <option value="ya">Ya</option>
        <option value="tidak">Tidak</option>
    </select><br>
    Durasi (hari): <input type="number" name="durasi" required><br>
    Downpayment: <input type="number" name="downpayment" required><br>
    <input type="submit" value="Sewa">
</form>
