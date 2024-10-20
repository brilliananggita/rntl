<?php 
if(isset($_POST['submit'])){
    include 'koneksi.php';

    $username = $_POST['username'];
    $role = $_POST['role'];
    $pass = md5($_POST['pass']); // Menggunakan MD5 untuk enkripsi password

    // Query untuk menambahkan data user
    $sql = "INSERT INTO tb_user (username, role , pass) 
            VALUES ('$username', '$role', '$pass')";

    if (mysqli_query($koneksi, $sql)) {
        echo "User berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>

<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Role: 
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
    </select><br>
    Password: <input type="password" name="pass" required><br>
    <button type="submit" name="submit">Submit</button>
</form>
