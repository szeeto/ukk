<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaraan Anggota - Aplikasi Perpustakaan Sekolah Digital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 row justify-content-center align-content-center">
        <form action="#" method="post" class="col-md-3 border p-4 bg-white rounded-4">
            <img src="logo.png" width="100px" class="mx-auto d-block">
            <h4 class="text-center">Pendaftraan Anggota</h4>
            <h5 class="text-center mb-3">Aplikasi Perpustakaan Sekolah Digital</h5>
            <input type="text" name="nis" class="form-control mb-3" placeholder="Masukan Nis Anda" requuired>
            <input type="text" name="nama_anggota" class="form-control mb-3" placeholder="Masukan Nama Anda" requuired>
            <input type="text" name="username" class="form-control mb-3" placeholder="Masukan Username Anda" requuired>
            <input type="text" name="password" class="form-control mb-3" placeholder="Masukan Password Anda" requuired>
            <input type="text" name="kelas" class="form-control mb-3" placeholder="Masukan Kelas Anda" requuired>
            <button name="tombol" type="submit" class="btn btn-success w-100 mb-2">Daftar</button>
            <a href="login-anggota.php" class="text-decoration-none">Login Sebagai Anggota</a><br>
            <a href="login-admin.php" class="text-decoration-none">Login Sebagai Admin</a>
<?php
if(isset($_POST['tombol'])){
    include 'koneksi.php';
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kelas = $_POST['kelas'];
    $query = "INSERT INTO anggota (nis,nama_anggota,username,password,kelas) VALUES ('$nis','$nama_anggota','$username','$password','$kelas')";
    $data = mysqli_query($koneksi, $query);
    if($data){
        session_start();
        $_SESSION ['id_anggota'] = mysqli_insert_id($koneksi);
        $_SESSION ['username'] = $username;
        $_SESSION ['nama_anggota'] = $nama_anggota;
        header ("Location:anggota/dashboard.php");
        exit();
    }else{
        echo " <script>alert('❌ Maaf Login Anda Gagal'); window.location.assign('login-anggota.php'); </script>";
    }
}
?>
    </div>
</body>
</html>