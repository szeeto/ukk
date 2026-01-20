<?php
    include '../koneksi.php'; 
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
    if(mysqli_num_rows($cek) > 0) {
        $data = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");
        if($data){
            echo "<script>alert('✅ Data Berhasil Dihapus'); window.location.assign('?halaman=data_buku');</script>";
        }else{
            echo "<script>alert('❌ Data Gagal Dihapus'); window.location.assign('?halaman=data_buku');</script>";
        }
    } else {
        echo "<script>alert('❌ Data Tidak Ditemukan'); window.location.assign('?halaman=data_buku');</script>";
    }
?>