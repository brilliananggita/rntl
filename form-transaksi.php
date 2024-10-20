<?php
session_start(); 
include 'koneksi.php'; // Koneksi ke database

// Cek apakah 'nopol' ada dalam query string
if (isset($_GET['nopol'])) {
    $nopol = $_GET['nopol'];
    $result = mysqli_query($koneksi, "SELECT * FROM tb_mobil WHERE nopol = '$nopol'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Mobil tidak ditemukan.";
        exit;
    }
    $hargaSewa = $row['harga']; // Ambil harga mobil dari database
} else {
    echo "Nomor polisi mobil tidak diberikan.";
    exit;
}

// Ambil username dari session (user yang login)
$username = $_SESSION['username'] ?? '';

// Fungsi untuk mengganti nama hari dan bulan ke bahasa Indonesia
function tanggalIndo($timestamp) {
    $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
    $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];

    $namaHari = $hari[date('l', $timestamp)];
    $tanggal = date('d', $timestamp);
    $namaBulan = $bulan[date('F', $timestamp)];
    $tahun = date('Y', $timestamp);

    return "$namaHari, $tanggal $namaBulan $tahun";
}

// Tampilkan tanggal sekarang dalam format bahasa Indonesia
$tanggalBooking = tanggalIndo(time());
$tanggalAmbil = tanggalIndo(strtotime('+1 day')); // Tanggal ambil 1 hari dari sekarang
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi Penyewaan Mobil</title>
    <script>
        function hitungTotal() {
            const hargaMobil = <?php echo $hargaSewa; ?>;
            const supir = document.getElementById('supir').value;
            let total = hargaMobil;
            let dp = parseFloat(document.getElementById('dp').value) || 0;

            if (supir === '1') {
                total += 100000; // Tambahkan biaya supir
            }

            let kekurangan = total - dp;
            document.getElementById('kekurangan').value = kekurangan;
            document.getElementById('total').value = total;
        }
    </script>
</head>
<body>
    <h2>Form Transaksi Penyewaan Mobil</h2>

    <form action="" method="post">
        <label for="username">Username (Penyewa):</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly><br><br>

        <label for="nopol">Nomor Polisi:</label>
        <input type="text" id="nopol" name="nopol" value="<?php echo $nopol; ?>" readonly><br><br>

        <label for="tgl_booking">Tanggal Booking:</label>
        <input type="text" id="tgl_booking" name="tgl_booking" value="<?php echo $tanggalBooking; ?>" readonly><br><br>

        <label for="tgl_ambil">Tanggal Ambil:</label>
        <input type="text" id="tgl_ambil" name="tgl_ambil" value="<?php echo $tanggalAmbil; ?>" readonly><br><br>

        <label for="tgl_kembali">Tanggal Kembali:</label>
        <input type="date" id="tgl_kembali" name="tgl_kembali" required><br><br>

        <label for="supir">Sewa Supir:</label>
        <select id="supir" name="supir" onchange="hitungTotal()">
            <option value="0">Tanpa Supir</option>
            <option value="1">Dengan Supir</option>
        </select><br><br>

        <label for="dp">Down Payment (DP):</label>
        <input type="text" id="dp" name="dp" value="0" oninput="hitungTotal()"><br><br>

        <label for="kekurangan">Kekurangan:</label>
        <input type="text" id="kekurangan" name="kekurangan" readonly><br><br>
        
        <label for="total">Total Biaya:</label>
        <input type="text" id="total" name="total" value="<?php echo $hargaSewa; ?>" readonly><br><br>

        <input type="submit" name="pinjam" value="Submit">
    </form>
</body>
</html>

<?php
// Menangani proses penyimpanan transaksi
if (isset($_POST['pinjam'])) {
    $nopol = $_POST['nopol'];
    $username = $_POST['username'];
    $supir = $_POST['supir'];
    $dp = $_POST['dp'];
    $kekurangan = $_POST['kekurangan'];
    $total = $_POST['total'];

    // Tanggal booking saat ini dan tanggal kembali
    $tgl_booking = date('Y-m-d');
    $tgl_ambil = date('Y-m-d', strtotime('+1 day')); // Tanggal ambil 1 hari dari sekarang
    $tgl_kembali = $_POST['tgl_kembali'];

    // Query untuk mengambil nik berdasarkan username dari tabel tb_member
    $result_member = $koneksi->query("SELECT nik FROM tb_member WHERE username = '$username'");

    if ($result_member) {
        $row_member = $result_member->fetch_assoc();

        // Jika nik ditemukan
        if ($row_member) {
            $nik = $row_member['nik'];

            // Query untuk menyimpan data transaksi ke tb_transaksi
            $sql = "INSERT INTO tb_transaksi (nik, nopol, tgl_booking, tgl_ambil, tgl_kembali, supir, total, downpayment, kekurangan, status) 
                    VALUES ('$nik', '$nopol', '$tgl_booking', '$tgl_ambil', '$tgl_kembali', '$supir', '$total', '$dp', '$kekurangan', 'booking')";
            $query = $koneksi->query($sql);

            if ($query) {
                // Update status mobil menjadi 'tidak tersedia'
                $sql1 = "UPDATE tb_mobil SET `status` = 'tidak' WHERE `nopol` = '$nopol'";
                $query1 = $koneksi->query($sql1);

                if ($query1) {
                    echo "<script>alert('Penyewaan berhasil!');</script>";
                } else {
                    echo "<script>alert('Gagal memperbarui status mobil!');</script>";
                }
            } else {
                echo "Error during insert: " . $koneksi->error;
            }
        } else {
            echo "<script>alert('Nama user tidak ditemukan!');</script>";
        }
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>
