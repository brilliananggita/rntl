<?php
if (isset($_POST['submit'])) {
    include 'koneksi.php';

    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $foto = $_POST['foto'];
    $status = 'tersedia'; // Status default mobil adalah tersedia

    $sql = "INSERT INTO tb_mobil (nopol, brand, type, tahun, harga, foto, status) 
              VALUES ('$nopol', '$brand', '$type', '$tahun', '$harga', '$foto', '$status')";

    if (mysqli_query($koneksi,$sql)) {
        echo "Mobil berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>

<form method="post" action="">
    Nomor Polisi: <input type="text" name="nopol"><br>
    Brand: <input type="text" name="brand"><br>
    Type: <input type="text" name="type"><br>
    Tahun: <input type="date" name="tahun"><br>
    Harga Sewa per Hari: <input type="text" name="harga"><br>
    Foto (URL): <input type="text" name="foto"><br>
    <button type="submit" name="submit"> Submit </button>
</form>
