<?php
session_start();
if(empty($_SESSION['id_admin'])){
    header("location:/login-admin.php");
}
include '../koneksi.php';

// Get admin name from database
$id_admin = $_SESSION['id_admin'];
$query_admin = mysqli_query($koneksi, "SELECT nama_admin FROM admin WHERE id_admin='$id_admin'");
$data_admin = mysqli_fetch_assoc($query_admin);
$nama_admin = isset($data_admin['nama_admin']) ? $data_admin['nama_admin'] : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin | Aplikasi Perpustakaan Sekolah Digital</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-3 mb-3">
        <h4>halaman Admin | Aplikasi Perpustakaan Sekolah Digital</h4>
        <a href="dashboard-admin.php" class="btn btn-success text-white">Dashboarad</a>
        <a href="?halaman=data_buku" class="btn btn-primary text-white">Buku</a>
        <a href="?halaman=data_anggota" class="btn btn-info text-white">Anggota</a>
        <a href="?halaman=data_peminjaman" class="btn btn-warning text-white">Peminjaman</a>
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
        <div class="card mt-3 p-3">
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman']:"";
            if(file_exists($halaman.".php")){
                include $halaman.".php";
            }else{
                ?>
                <h4>Selamat Datang <?= $nama_admin;?>👋</h4>
                <p class="text-jusify text-muted">
                    Aplikasi Perpustakaan Sekolah Digital Merupakan Sistem Berbasis Web Yang Dirancang Untuk Membantu Pengelolaan Data Buku, Data Anggota Dan Peminjaman Terorganisir
                </p>
            <?php }?>
        </div>
    </div>
</body>
</html>