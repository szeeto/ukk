<?php
    include '../koneksi.php'; 
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$id'");
    if(mysqli_num_rows($cek) > 0) {
        $data = mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota='$id'");
        if($data){
            echo "<script>alert('✅ Data Berhasil Dihapus'); window.location.assign('?halaman=data_anggota');</script>";
        }else{
            echo "<script>alert('❌ Data Gagal Dihapus'); window.location.assign('?halaman=data_anggota');</script>";
        }
    }
?>