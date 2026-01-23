<?php
session_start();
if(empty($_SESSION['id_anggota'])){
    header("location:/login-anggota.php");
}
include '../koneksi.php';
$id_anggota = $_SESSION['id_anggota'];
$query_anggota = mysqli_query($koneksi, "SELECT nama_anggota FROM anggota WHERE id_anggota ='$id_anggota '");
$data_anggota = mysqli_fetch_assoc($query_anggota);
$nama_anggota = isset($data_anggota['nama_anggota']) ? $data_anggota['nama_anggota'] : 'anggota';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Anggota | Aplikasi Perpustakaan Sekolah Digital</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-3 mb-3">
        <h4>halaman Admin | Aplikasi Perpustakaan Sekolah Digital</h4>
        <a href="dashboard.php" class="btn btn-success text-white">Dashboarad</a>
        <a href="?halaman=history" class="btn btn-success text-white">History Peminjaman</a>
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
        <div class="card mt-3 p-3">
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman']:"";
            if(file_exists($halaman.".php")){
                include $halaman.".php";
            }else{
                ?>
                <h4>Selamat Datang <?= strtolower($nama_anggota);?>👋</h4>
                <p class="text-jusify text-muted">
                    Aplikasi Perpustakaan Sekolah Digital Merupakan Sistem Berbasis Web Yang Dirancang Untuk Membantu Pengelolaan Data Buku, Data Anggota Dan Peminjaman Terorganisir
                </p>
            <?php }?>
        </div>
    </div>
</body>
</html>