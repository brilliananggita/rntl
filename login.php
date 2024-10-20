<?php
session_start();
if (isset($_POST['submit'])) {
    include 'koneksi.php';

    $username = $_POST['username'];
    $pass = md5($_POST['pass']); // Enkripsi password menggunakan MD5

    // Query untuk mengecek di tb_user
    $sql_user = "SELECT * FROM tb_user WHERE username = '$username' AND pass = '$pass'";
    $result_user = mysqli_query($koneksi, $sql_user);

    if (mysqli_num_rows($result_user) > 0) {
        // Jika ditemukan di tb_user
        $row_user = mysqli_fetch_assoc($result_user);
        $_SESSION['username'] = $row_user['username'];
        $_SESSION['role'] = $row_user['role'];

        // Redirect berdasarkan peran user di tb_user
        if ($row_user['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row_user['role'] == 'petugas') {
            header("Location: petugas.php");
        }
    } else {
        // Jika tidak ditemukan di tb_user, cek di tb_member
        $sql_member = "SELECT * FROM tb_member WHERE username = '$username' AND pass = '$pass'"; // Perhatikan, kolomnya juga 'pass'
        $result_member = mysqli_query($koneksi, $sql_member);

        if (mysqli_num_rows($result_member) > 0) {
            // Jika ditemukan di tb_member
            $row_member = mysqli_fetch_assoc($result_member);
            $_SESSION['username'] = $row_member['username'];
            $_SESSION['nik'] = $row_member['nik']; // Simpan NIK jika perlu

            // Redirect ke halaman member atau halaman lain
            header("Location: index.php");
        } else {
            // Jika tidak ditemukan di kedua tabel
            echo "Username atau password salah.";
        }
    }

    mysqli_close($koneksi);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Warna latar belakang biru muda */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
/* 
        h1 {
            text-align: center;
            color: #007bff;
        } */
        h2 {
            text-align: center;
            color: #007bff;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #007bff;
            border-radius: 4px;
        }

        button {
            width: 100%;
            background-color: #007bff; /* Warna biru untuk tombol */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3; /* Biru yang lebih gelap ketika di-hover */
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<!-- <h1>Selamat datang di halaman Login Rental Mobil</h1> -->



    <form method="post" action="">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br>

        <button type="submit" name="submit">Login</button>

        <!-- Pesan kesalahan jika login gagal -->
        <div class="error-message">
            <?php if (isset($error_message)) echo $error_message; ?>
        </div>
    </form>

</body>
</html>



<!-- <form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="pass" required><br>
    <button type="submit" name="submit">Login</button>
</form> -->
