<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota- Aplikasi Perpustakaan Sekolah Digital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 row justify-content-center align-content-center">
        <form action="#" method="post" class="col-md-3 border p-4 bg-white rounded-4">
            <img src="logo.png" width="100px" class="mx-auto d-block">
            <h4 class="text-center">Login Anggota</h4>
            <h5 class="text-center mb-3">Aplikasi Perpustakaan Sekolah Digital</h5>
            <input type="text" name="username" class="form-control mb-3" placeholder="Masukan Username Anda" requuired>
            <input type="password" name="password" class="form-control mb-3" placeholder="Masukan Password Anda" requuired>
            <button name="tombol" type="submit" class="btn btn-success w-100 mb-2">Login</button>
            <a href="login-admin.php" class="text-decoration-none">Login Sebagai Admin</a><br>
            <a href="pendaftaran-anggota.php" class="text-decoration-none">Pendaftraan Anggota</a><br>


<?php
if(isset($_POST['tombol'])){
    include 'koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM anggota WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $query);
    if($data && mysqli_num_rows($data)>0){
        $data = mysqli_fetch_array($data);
        session_start();
        $_SESSION ['id_anggota'] = $data ['id_anggota'];
        $_SESSION ['username'] = $data ['username'];
        $_SESSION ['nama_anggota'] = $data ['nama_anggota'];
        header ("Location:anggota/dashboard.php");
        exit();
    }else{
        echo " <script>alert('❌ Maaf Login Anda Gagal'); window.location.assign('login-anggota.php'); </script>";
    }
}
?>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>